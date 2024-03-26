<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $users->each(function(User $user){
            Account::factory(1)->create([
                'user_id' => $user->id

            ])->each(function(Account $account){
                Transaction::factory(2)->create([
                    'account_id'=> $account->id

                ])->each(function(Transaction $transaction){
                    Item::factory(4)->create([
                        'transaction_id' => $transaction->id,
                    ]);

                });
            });
        });
    }
}
