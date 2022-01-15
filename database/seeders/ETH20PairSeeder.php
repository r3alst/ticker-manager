<?php

namespace Database\Seeders;

use App\Models\Pair;
use App\Models\Token;
use Illuminate\Database\Seeder;

class ETH20PairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tokens = [
            [
                "name" => "USDT",
                "symbol" => "USDT",
                "contract" => "0xdac17f958d2ee523a2206206994597c13d831ec7",
                "rate" => 0,
                "balance" => 0,
                "precision" => 6,
                "network" => Pair::ETH_MAINNET
            ],
            [
                "name" => "MANA",
                "symbol" => "MANA",
                "contract" => "0x0F5D2fB29fb7d3CFeE444a200298f468908cC942",
                "rate" => 0,
                "balance" => 0,
                "precision" => 18,
                "network" => Pair::ETH_MAINNET
            ]
        ];
        $pairs = [
            [
                "name" => "MANAUSDT",
                "f_token" => "MANA",
                "t_token" => "USDT",
                "price" => 0,
                "network" => Pair::ETH_MAINNET,
                "container_name" => null,
                "container_status" => null
            ]
        ];

        foreach ($tokens as $token) {
            $_token = Token::query()->where([
                "symbol" => $token["symbol"],
                "network" => $token["network"]
            ])->first();
            if(!$_token) {
                $_token = new Token();
            }
            $_token->name = $token["name"];
            $_token->symbol = $token["symbol"];
            $_token->contract = $token["contract"];
            $_token->rate = $token["rate"];
            $_token->balance = $token["balance"];
            $_token->precision = $token["precision"];
            $_token->network = $token["network"];
            $_token->save();
        }

        foreach ($pairs as $pair) {
            $_pair = Pair::query()->where([
                "name" => $pair["name"],
                "network" => $pair["network"],
            ])->first();
            if(!$_pair) {
                $_pair = new Pair();
            }
            $f_token = Token::query()->where([
                "symbol" => $pair["f_token"],
                "network" => $pair["network"],
            ])->first();
            $t_token = Token::query()->where([
                "symbol" => $pair["t_token"],
                "network" => $pair["network"],
            ])->first();
            $_pair->name = $pair["name"];
            $_pair->price = $pair["price"];
            $_pair->network = $pair["network"];
            $_pair->f_token = $f_token->id;
            $_pair->t_token = $t_token->id;
            $_pair->container_name = $pair["container_name"];
            $_pair->container_status = $pair["container_status"];
            $_pair->save();
        }
    }
}
