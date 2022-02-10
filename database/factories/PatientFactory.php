<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{

    protected $names = [
        'Mr. Boots',
        'Big Guy',
        'Fluffy',
        'T-Bone',
        'Doodle',
        'Ruff',
        'Charles Barky',
        'Goose',
        'Banjo',
        'Red',
        'Biscuit',
        'Snickers',
        'Bingo',
        'Bubba',
        'Buck',
        'Buttercup',
        'Ewok',
        'Lassie',
        'Tiger',
        'Bacon',
        'Mr. Butters',
        'Huck',
        'Pancake',
        'Porkchop',
        'Sherlock',
        'Splashy',
        'Waffles',
        'Woofer',
        'Zippy',
        'Bubblegum',
        'Doogie',
    ];

    protected $species = [
        'Golden Retriever',
        'Alaskan Husky',
        'German Shepherd',
        'Bulldog',
        'Black Labrador',
        'Jindo',
        'Pitbull',
        'Pomeranian',
        'Alaskan Malamute',
        'Jack Russell Terrier',
        'Basset Hound',
        'Beagle',
        'Belgian Malinois',
        'Boxer',
        'Chihuahua',
        'Collie',
        'Dachshund',
        'Dalmatian',
    ];

    protected $colors = [
        'White',
        'Black',
        'Golden',
        'Light Brown',
        'Dark Brown',
        'Gray',
        'Red',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->names[$this->faker->numberBetween(0, 30)],
            'species' => $this->species[$this->faker->numberBetween(0, 17)],
            'color' => $this->colors[$this->faker->numberBetween(0, 6)],
            'dob' => $this->faker->date(),
        ];
    }
}
