<?php
class Validate
{
    function is_valid_credit_card($card_number): string
    {
        $sum = 0;
        $len = strlen($card_number);
        $emitent = $this->emitent($card_number);
        for ($i=0; $i < $len; $i++)
        {
            $val= $card_number % 10;
            $card_number = intdiv($card_number, 10);

            if($i%2 != 0)
            {
                $val *= 2;

                if($val>9)
                    $val -= 9;
            }
            $sum += $val;
        }
        // число корректно, если сумма равна 10
        if ($sum % 10 == 0)
        {
            return 'valid card ' . $emitent;
        }
        else
        {
            return 'no valid card';
        }
    }

    function emitent($card_number): string
    {
        $visa = '/^(4[0-9]|14)+[0-9]{11,17}$/';

        $master_card = '/^(5[1-5]|62|67)+[0-9]{11,17}$/';

        if (preg_match($master_card, $card_number))
        {
            return " MasterCard ";
        }
        else if (preg_match($visa, $card_number))
        {
            return " Visa ";
        }
        else
        {
            return "Not defined emitent";
        }
    }
}
$validate = new Validate();
echo $validate->is_valid_credit_card(readline('введите номер карты: '));
