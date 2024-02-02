<?php

namespace App\BudgetTracker\Factories;

use Faker\Provider\DateTime;
use App\BudgetTracker\Models\Account;
use App\BudgetTracker\Enums\EntryType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class InvestmentsFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = "\App\\BudgetTracker\\Models\\Investments";

    protected static $namespace = 'App\\BudgetTracker\\Factories';


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->numberBetween(-1,-50);
        $usrIdDemo =config('app.config.demo_user_id');
        $date = DateTime::dateTimeBetween('-1 years','+1 years');

        return [
            'uuid' => uniqid(),
            'amount' => $amount,
            'note' => fake()->text(80),
            'type' => EntryType::Investments->value,
            'transfer' => 0,
            'category_id' => 60,
            'account_id' => Account::where('user_id', $usrIdDemo)->get('id')[0]->id,
            'currency_id' => 1,
            'date_time' => $date->format('Y-m-d H:i:s'),
            'payment_type' => 1,
            'confirmed' => 1,
            'planned' => 0,
            'user_id' => config('app.config.demo_user_id')

        ];
    }
}
