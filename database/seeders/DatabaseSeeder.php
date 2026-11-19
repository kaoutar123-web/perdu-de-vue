<?php

namespace Database\Seeders;

use App\Enums\Color;
use App\Enums\PlaceKind;
use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $places = [
            'hall' => Place::create(['name' => 'Hall des guichets', 'kind' => PlaceKind::Hall]),
            'quai1' => Place::create(['name' => 'Quai 1', 'kind' => PlaceKind::Platform]),
            'quai2' => Place::create(['name' => 'Quai 2', 'kind' => PlaceKind::Platform]),
            'train' => Place::create(['name' => 'Train de 8 h 12', 'kind' => PlaceKind::Train]),
        ];

        $tags = [];
        foreach (['fragile', 'vivant', 'précieux', 'sentimental', 'utile', 'encombrant', 'insolite', 'mouillé'] as $name) {
            $tags[$name] = Tag::create(['name' => $name]);
        }

        $items = [
            ['hall', 'Chargeur iPhone', "Câble blanc avec un petit nœud de ruban adhésif près de la prise, bloc d'alimentation fendu sur un côté.", Color::White, '2026-10-02', null, ['utile', 'fragile']],
            ['quai1', 'Petite plante', 'Plante grasse dans un pot en terre cuite, une feuille cassée, une étiquette avec le prénom « Léa ».', Color::Green, '2026-10-03', null, ['vivant', 'fragile']],
            ['train', 'Portefeuille en cuir', 'Portefeuille brun, coins usés, contient une carte de bibliothèque et deux tickets de caisse.', Color::Brown, '2026-10-05', '2026-10-09', ['précieux', 'utile']],
            ['quai2', 'Sac Bershka avec un bonnet', 'Sac de magasin noir à poignées, contenant un bonnet gris en laine encore avec son étiquette.', Color::Black, '2026-10-06', null, ['utile']],
            ['hall', 'Montre Casio', "Montre digitale à bracelet noir, rayure sur le cadran, l'alarme sonne encore.", Color::Black, '2026-10-07', '2026-10-13', ['précieux', 'sentimental']],
            ['train', 'Farde à rabats', 'Farde bleue avec élastique contenant des feuilles de cours annotées au surligneur jaune.', Color::Blue, '2026-10-08', null, ['utile', 'sentimental']],
            ['quai1', 'Lunettes de soleil en forme de cœur', 'Monture rose, un verre rayé, étui absent.', Color::Pink, '2026-10-09', null, ['insolite', 'fragile']],
            ['quai2', 'Sac de couchage mauve', 'Enroulé avec une sangle, sent le feu de camp, la fermeture éclair se coince.', Color::Purple, '2026-10-12', null, ['encombrant', 'mouillé']],
            ['hall', 'Gant de boxe gauche', 'Cuir rouge usé, initiales « M.D. » écrites au feutre sur le poignet.', Color::Red, '2026-10-13', null, ['insolite']],
            ['train', 'Livre de mots croisés', 'Presque terminé, un crayon coincé dans la reliure, une seule grille encore vide.', Color::Blue, '2026-10-14', null, ['sentimental', 'utile']],
            ['quai1', 'Collier en or', 'Chaîne fine avec un pendentif en forme de trèfle, fermoir tordu.', Color::Yellow, '2026-10-16', '2026-10-20', ['précieux', 'sentimental', 'fragile']],
            ['quai2', 'Veste en fourrure', 'Fausse fourrure beige, doublure rouge, un bouton remplacé par un bouton noir.', Color::Brown, '2026-10-19', null, ['encombrant', 'précieux']],
            ['hall', 'Carte MOBIB dans son étui', 'Étui transparent avec un autocollant de chat, carte au nom partiellement effacé.', Color::Blue, '2026-10-21', null, ['utile']],
            ['train', 'Thermos de café', 'Thermos vert foncé, encore tiède, avec une bosse sur le fond.', Color::Green, '2026-10-23', null, ['utile', 'mouillé']],
            ['quai1', 'Écouteurs sans fil', "Boîtier blanc rayé, l'écouteur gauche est absent, un porte-clés étoile accroché.", Color::White, '2026-10-26', null, ['fragile', 'utile']],
        ];

        foreach ($items as [$placeKey, $name, $description, $color, $foundOn, $returnedAt, $tagNames]) {
            $item = Item::create([
                'place_id' => $places[$placeKey]->id,
                'name' => $name,
                'description' => $description,
                'color' => $color,
                'found_on' => $foundOn,
                'returned_at' => $returnedAt,
            ]);

            $item->tags()->attach(
                collect($tagNames)->map(fn ($tagName) => $tags[$tagName]->id)->all()
            );
        }
    }
}
