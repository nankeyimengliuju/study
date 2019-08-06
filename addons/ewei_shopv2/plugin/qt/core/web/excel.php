<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Excel_EweiShopV2Page extends PluginWebPage
{

    public function main()
    {

        $this->addExcel();

    }




//接收前台文件，
    public  static function addExcel()
    {

        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';



        $dir = dirname(__FILE__);

            //接收前台文件
        $ex = $_FILES['excel'];
        //重设置文件名
        $filename = time().substr($ex['name'],stripos($ex['name'],'.'));
        $path = $dir.$filename;//设置移动路径
        move_uploaded_file($ex['tmp_name'],$path);
        $objPHPExcelReader = PHPExcel_IOFactory::load($path);

        if(file_exists($path)){
            unlink($path);
        }

        //读取第一张表
        $sheet = $objPHPExcelReader->getSheet(0);
        //获取总行数
        $row_num = $sheet->getHighestRow();
        //获取总列数
        $col_num = $sheet->getHighestColumn();

        $data = []; //数组形式获取表格数据
        for($col='A';$col<=$col_num;$col++)
        {
            //从第二行开始，去除表头（若无表头则从第一行开始）
            for($row=1;$row<=$row_num;$row++)
            {
                $data[$row-2][] = $sheet->getCell($col.$row)->getValue();
            }
        }

        return $data;

    }




}