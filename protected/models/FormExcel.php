<?php 
class FormExcel extends CFormModel {
    public $file;
    public $kd_periode;

    public function rules() {
        return array(
       // array('kd_periode', 'required'),
        array(
            'file',
            'file',
            'types'=>'csv',
            'maxSize'=>1024 * 1024 * 10, //10MB
            'tooLarge'=>'File melebihi 10MB. Pilih file CSV lain.',
            'allowEmpty'=>false,
            ),
       
        );
    }

    public function attributeLabels() {
        return array(
        'file'=>'File CSV',
        'kd_periode'=>'kd periode',
        );
    }
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
?>