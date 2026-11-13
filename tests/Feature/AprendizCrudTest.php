<?php

namespace Tests\Feature;

use App\Models\Aprendiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AprendizCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_an_apprentice(): void
    {
        $response = $this->post(route('aprendices.store'), [
            'nombre' => 'Ana Pérez',
            'documento' => '1234567890',
            'correo' => 'ana@example.com',
            'ficha_id' => 123456,
        ]);

        $response->assertRedirect(route('aprendices.index'));
        $this->assertDatabaseHas('aprendices', [
            'nombre' => 'Ana Pérez',
            'documento' => '1234567890',
            'correo' => 'ana@example.com',
            'ficha_id' => 123456,
        ]);
    }

    public function test_it_rejects_duplicate_document_and_email(): void
    {
        Aprendiz::factory()->create([
            'documento' => '1234567890',
            'correo' => 'ana@example.com',
        ]);

        $this->from(route('aprendices.create'))
            ->post(route('aprendices.store'), [
                'nombre' => 'Otra persona',
                'documento' => '1234567890',
                'correo' => 'ana@example.com',
            ])
            ->assertSessionHasErrors(['documento', 'correo']);
    }

    public function test_it_shows_updates_and_deletes_an_apprentice(): void
    {
        $aprendiz = Aprendiz::factory()->create();

        $this->get(route('aprendices.edit', $aprendiz))
            ->assertOk()
            ->assertSee('name="_method" value="PUT"', false)
            ->assertSee('name="nombre" value="'.$aprendiz->nombre.'"', false)
            ->assertSee('name="documento" value="'.$aprendiz->documento.'"', false)
            ->assertSee('name="correo" value="'.$aprendiz->correo.'"', false)
            ->assertSee('name="ficha_id" value="'.$aprendiz->ficha_id.'"', false);

        $this->get(route('aprendices.show', $aprendiz))
            ->assertOk()
            ->assertSee($aprendiz->nombre);

        $this->get(route('aprendices.index'))
            ->assertOk()
            ->assertSee("confirm('¿Desea eliminar este aprendiz?')", false);

        $this->put(route('aprendices.update', $aprendiz), [
            'nombre' => 'Nombre actualizado',
            'documento' => $aprendiz->documento,
            'correo' => $aprendiz->correo,
            'ficha_id' => 654321,
        ])->assertRedirect(route('aprendices.index'));

        $this->assertDatabaseHas('aprendices', [
            'id' => $aprendiz->id,
            'nombre' => 'Nombre actualizado',
            'ficha_id' => 654321,
        ]);

        $this->delete(route('aprendices.destroy', $aprendiz))
            ->assertRedirect(route('aprendices.index'));

        $this->assertDatabaseMissing('aprendices', ['id' => $aprendiz->id]);
    }

    public function test_it_displays_validation_errors_and_preserves_old_input(): void
    {
        $response = $this->from(route('aprendices.create'))
            ->post(route('aprendices.store'), [
                'nombre' => 'Ana Pérez',
                'documento' => '',
                'correo' => 'correo-invalido',
                'ficha_id' => 0,
            ]);

        $response->assertRedirect(route('aprendices.create'))
            ->assertSessionHasErrors(['documento', 'correo', 'ficha_id'])
            ->assertSessionHas('_old_input.nombre', 'Ana Pérez');

        $this->get(route('aprendices.create'))
            ->assertOk()
            ->assertSee('name="nombre" value="Ana Pérez"', false)
            ->assertSee('El documento es obligatorio.')
            ->assertSee('El correo no es válido.')
            ->assertSee('La ficha debe ser mayor que cero.');
    }

    public function test_it_searches_by_name_or_document(): void
    {
        $nameMatch = Aprendiz::factory()->create([
            'nombre' => 'María Gómez',
            'documento' => '1111111111',
        ]);
        $documentMatch = Aprendiz::factory()->create([
            'nombre' => 'Carlos Ruiz',
            'documento' => '2222222222',
        ]);
        Aprendiz::factory()->create([
            'nombre' => 'Laura Torres',
            'documento' => '3333333333',
        ]);

        $this->get(route('aprendices.index', ['q' => 'María']))
            ->assertOk()
            ->assertSee('action="'.route('aprendices.index').'" method="GET"', false)
            ->assertSee('name="campo"', false)
            ->assertSee('value="nombre"', false)
            ->assertSee($nameMatch->nombre)
            ->assertDontSee($documentMatch->nombre);

        $this->get(route('aprendices.index', ['campo' => 'documento', 'q' => '2222222222']))
            ->assertOk()
            ->assertSee($documentMatch->nombre)
            ->assertDontSee($nameMatch->nombre);

        $this->get(route('aprendices.index', ['campo' => 'correo', 'q' => 'laura']))
            ->assertOk()
            ->assertSee('Laura Torres')
            ->assertDontSee($documentMatch->nombre);
    }

    public function test_pagination_keeps_the_search_query_and_filters_each_page(): void
    {
        for ($i = 0; $i < 12; $i++) {
            Aprendiz::factory()->create([
                'nombre' => sprintf('Ana Aprendiz %02d', $i),
                'created_at' => now()->addSeconds($i),
                'updated_at' => now()->addSeconds($i),
            ]);
        }

        Aprendiz::factory()->create([
            'nombre' => 'Carlos Ruiz',
            'documento' => '9999999999',
            'correo' => 'carlos@example.com',
        ]);

        $this->get(route('aprendices.index', ['q' => 'Ana']))
            ->assertOk()
            ->assertSee('q=Ana&amp;page=2', false)
            ->assertSee('Ana Aprendiz 11')
            ->assertDontSee('Ana Aprendiz 01')
            ->assertDontSee('Carlos Ruiz');

        $this->get(route('aprendices.index', ['q' => 'Ana', 'page' => 2]))
            ->assertOk()
            ->assertSee('Ana Aprendiz 01')
            ->assertSee('Ana Aprendiz 00')
            ->assertDontSee('Ana Aprendiz 11')
            ->assertDontSee('Carlos Ruiz');
    }
}
