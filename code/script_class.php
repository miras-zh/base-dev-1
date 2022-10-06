<?php

abstract class SuperMan{

}
class GrandPa{
    public string $hair = 'black';
    public string $body = 'normal';
    protected string $nose = 'krivoi';
    private string $skill = 'basketball';
    public function showGrandPaNose(){
        echo $this->nose;
    }
    protected function sayGrandPa(){
        return 'GrandPa Saying...*)';
    }
}

class Man extends GrandPa {
    protected string $hairs = 'brown';
    public function sayGrandPa(){
        $say = parent::sayGrandPa();
        echo $say;
    }

    public function eat($calories){
        if($calories > 500){
            $this->body = 'tolstyi';
        }else{
            $this->body = 'hydoi';
        }
    }

    public function reColor($color){
        $this->hairs = $color;
        echo 'reColor hair = '.$this->hairs;
    }
}
//$spiderman = new SuperMan();
$masha = new Man();
$aira= new Man();
$dos = new Man();
$masha->sayGrandPa();

$aira->reColor('white');

echo '<div>====================================</div>';
$masha->showGrandPaNose();

//echo '-> masha hair = '.$masha -> hair.'<br/>';
//echo '-> dos '.$dos -> body.'<br/>';
//$masha -> hair = 'white';
//echo 'masha hair = '.$masha -> hair;
//echo '<div>====================================</div>';

//echo 'body masha > '. $masha->body.'<br>';
//echo 'body dos > '. $dos->body.'<br>';

//$masha->eat(400);
//$dos->eat(800);
//echo '<br>';
//echo 'body masha > '. $masha->body.'<br>';
//echo 'body dos > '. $dos->body.'<br>';

echo '<div>====================================</div>';
//echo '<div>test PHP</div>';
