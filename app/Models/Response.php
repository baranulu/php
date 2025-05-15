<?php
 namespace App\Models;
 
class Response
{
    public $value;      // Dönen veri
    public $result;   // Durum: true false
    public $exception;  // Hata mesajı (varsa)

    public function __construct($value = null, $result = false, $exception = 'Beklenmeyen bir hata oluştu.')
    {
        $this->value = $value;
        $this->result = $result;
        $this->exception = $exception;
    }
}
?>
