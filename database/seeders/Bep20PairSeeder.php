<?php

namespace Database\Seeders;

use App\Models\Pair;
use App\Models\Token;
use Illuminate\Database\Seeder;

class Bep20PairSeeder extends Seeder
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
                "name" => "BUSD",
                "symbol" => "BUSD",
                "contract" => "0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56",
                "rate" => 1,
                "balance" => 0,
                "precision" => 18,
                "network" => Pair::BSC_MAINNET
            ],
            [
                "name" => "IDIA",
                "symbol" => "IDIA",
                "contract" => "0x0b15Ddf19D47E6a86A56148fb4aFFFc6929BcB89",
                "rate" => 1.12,
                "balance" => 0,
                "precision" => 18,
                "network" => Pair::BSC_MAINNET
            ],
            [
                "name" => "WBNB",
                "symbol" => "WBNB",
                "contract" => "0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c",
                "rate" => 0,
                "balance" => 0,
                "precision" => 18,
                "network" => Pair::BSC_MAINNET
            ]
        ];
        $pairs = [
            [
                "name" => "IDIABUSD",
                "f_token" => "IDIA",
                "t_token" => "BUSD",
                "price" => 0,
                "network" => Pair::BSC_MAINNET,
                "container_name" => null,
                "container_status" => null
            ],
            [
                "name" => "WBNBBUSD",
                "f_token" => "WBNB",
                "t_token" => "BUSD",
                "price" => 0,
                "network" => Pair::BSC_MAINNET,
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
