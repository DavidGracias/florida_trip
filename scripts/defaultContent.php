<?php
function getDefault($identifier, $column){
    switch($identifier){
        case "Intro":
            return <<<HEREDOC
Welcome to PWHS Senior Trip website! On this site you can manage trip payments, view fundraisers, view important trip information, and more!
HEREDOC;
        case "PackingList-Clothes":
            if($column == "content")
                return <<<'HEREDOC'
5 shirts/shorts for parts
Warmer clothes for night (at hotel)
Sweatshirt
Something to sleep in
Bathing suit
Flip flops
Sneakers
Socks
Nice outfit
Underwear
HEREDOC;
            else if($column == "extra")
                return <<<'HEREDOC'
5 shirts/shorts for parts
Warmer clothes for night (at hotel)
Sweatshirt
Pajamas
Bathing suit
Flip flops
Sneakers
Socks
Nice outfit
Underwear
Robe
Bras
Coverup
HEREDOC;
        case "PackingList-Toiletries":
            if($column == "content")
                return <<<'HEREDOC'
Sunscreen
Deodorant
Toothpaste
Toothbrush
Shampoo
Soap
Razor
Shaving cream
Q-tips
Lotion
Hair styling products
Advil
Chapstick
Bandaids
Throat lozenges (cough drops)
Comb
HEREDOC;
            else if($column == "extra")
                return <<<'HEREDOC'
Sunscreen
Deodorant
Toothpaste
Toothbrush
Shampoo
Conditioner
Razor
Shaving cream
Q-tips
Lotion
Hair styling products
Advil
Chapstick
Bandaids
Throat lozenges (cough drops)
Feminine products
Makeup/makeup remover
HEREDOC;
        case "PackingList-Other":
            if($column == "content")
                return <<<'HEREDOC'
Phone
Headphones
Phone charger
Hat
Sunglasses
Water bottle (unfilled -- nalgene, hydro flask, swell, etc.)
Backpack/drawstring bag
Cash for incidentals ($100ish)
Beach towel
HEREDOC;
            else if($column == "extra")
                return <<<'HEREDOC'
Phone
Headphones
Phone charger
Hat
Sunglasses
Water bottle (unfilled -- nalgene, hydro flask, swell, etc.)
Backpack/drawstring bag
Cash for incidentals ($100ish)
Beach towel
Hairdryer (there is one in room)
Hairbrush
Hair accessories (ponytail holders, headbands, etc.)
Straightener/curling iron
HEREDOC;
        case "Finances-Payments":
            if($column == "content")
                return <<<'HEREDOC'
HEREDOC;
            else if($column == "extra")
                return <<<'HEREDOC'
HEREDOC;
    }
}
?>