<?php

namespace FalloutGrabber;

class View
{


    public function introCardSet(): string {
        return '    <div class="col-sm-10">
                        <h2 class="mt-5">CardSet Overview</h2>
                        <h5>CardSet overview over different CardTypes.</h5>
                        <p>Select CardType</p>
                    </div>';
    }

    public function showCardSet($set, $cards): string {
        $content = '<div class="col-sm-10">
                        <h2 class="mt-5">Cardset</h2>
                        <h5>' . $set . '
                        <button type="button" hx-get="/?action=downloadSet&set=' . $set . '" class="bi-cloud-download btn btn-primary"> </button></h5>
                        <p>Overview over set</p>';

        $content .= '    <div class="row">';

        for ($i = 0; $i < $cards[3]; $i++) {
            $content .= $this->showDetailCard($i, $set, $cards[4],$cards['Names'][$i]);
        }
        $content .= '     </div>
                    </div>';
        return $content;
    }

    public function showCards($cards): string {
        $content = '    <div class="row">';

        foreach ($cards as $card){
            $content .=$this->showDetailCard((int)reset($card), key($card),$card[0]);
        }
        $content .= '     </div>';
        return $content;
    }

    public function showDetailCard(int $cardNr, string $set, $row, $title = null): string {
        $cardRow = floor($cardNr / $row);
        $cardColumn = $cardNr  % $row;

        return $this->showCard($title,
            '/storage/imageCache/' . $set . '/' . $cardRow . '-' . $cardColumn . '.png',
            $set.'-'.$cardNr,
            $this->addButton($set, $cardRow, $cardColumn),
            $this->loadButton($set, $cardNr));
    }

    public function showCard($cardTitle, $imageUrl, $cardName, $addButton = null, $loadButton = null, $size = 3): string {
        return ('         ');
    }

}