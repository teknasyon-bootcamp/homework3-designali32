<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */
class Form{
    //property tanımları yapıldı
    protected string $action;
    protected string $method;
    protected $fields=[];

    private function __construct(string $action,string $method){
        //private constructor tanımlandı. Action ve method değerleri atandı.
        $this->action=$action;
        $this->method=$method;
    }
    //istenen static formlar tanımlandı
    public static function createForm(string $action,string $method): Form{
        //dışardan gelen metoda göre nesne oluşturuyor
        return new static($action,$method);
    }
    public static function createGetForm(string $action,string $method="GET"): Form{
    //get method nesnesi oluşturuyor
        return new static($action,"GET");
    }
    public static function createPostForm(string $action,string $method="POST"): Form{
    //post method nesnesi oluşturuyor
        return new static($action,"POST");
    }
    public function addField(string $label,string $name,?string $defaultValue=null): void{
        //field değerlerini aşağıda ekrana basarken kullanacağımız için kolaylık sağlaması adına isim verildi
        //name label defaultValue değerleri diziye eklendi
        $this->fields[$name]=[
            "label"=>$label,
            "name"=>$name,
            "defaultValue"=>$defaultValue];
    }
    public function setMethod(string $method): void{
        //method herhangi bir şekilde tekrar tetiklenmesi halinde methodu değiştiren setMethod methodu tanımlandı
        $this->method=$method;
    }
    public function render(): void{
        //metodlardan gelen değerlere göre html çıktısı ekrana basıldı
        echo "<form method='$this->method' action='$this->action'>\n";
        foreach ($this->fields as $field) {
            //fields dizi olduğu için ekrana basılması için foreach döngüsü kullanılarak ekrana veriler basıldı
            echo "<label for='$field[name]'>$field[label] </label>\n<input type='text' name='$field[name]' value='$field[defaultValue]' /> \n";
        }
            echo "<button type='submit'>Gönder</button>\n</form>\n";
    }
}