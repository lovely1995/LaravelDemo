<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \ECPay_PaymentMethod as ECPayMethod;
//use ECPay_AllInOne as ECPay;
// 1. composer.json -> create  file path in classmap
// 2. composer dump-autoload reload composer
// 3.use \ECPay_PaymentMethod as ECPayMethod; ***note->\
// 4. $obj = new \ECPay_AllInOne(); ***note->\
class Paycontroller extends Controller
{
    public function index(){
		return view('pay.index');
    }
    public function store(Request $request){
    	$this->validate($request,[
    		'TotalAmount'=>'required',
    		'TradeDesc'=>'required',
    		'Iteminfo'=>'required',
            'Total_quantity'=>'required'
    	]);


    try {
        
    	$obj = new \ECPay_AllInOne();
   
        //服務參數
        $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";
        //服務位置
        $obj->HashKey     = '5294y06JbISpM5x9' ;//測試用Hashkey，請自行帶入ECPay提供的HashKey
        $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;//測試用HashIV，請自行帶入ECPay提供的HashIV
        $obj->MerchantID  = '2000132';//測試用MerchantID，請自行帶入ECPay提供的MerchantID
        $obj->EncryptType = '1';//CheckMacValue加密類型，請固定填入1，使用SHA256加密


        //基本參數(請依系統規劃自行調整)
        $MerchantTradeNo = "Test".time() ;
        $obj->Send['ReturnURL']         = "http://www.ecpay.com.tw/receive.php" ;   
        //付款完成通知回傳的網址
        $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;  //訂單編號
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');  //交易時間
        $obj->Send['TotalAmount']       = $request->TotalAmount;  //交易金額
        $obj->Send['TradeDesc']         = $request->TradeDesc;  //交易描述
        $obj->Send['ChoosePayment']     = 'ALL' ;  //付款方式:全功能


        $item_info=$request->Iteminfo;//取得所有商品資訊
        $Total_quantity=$request->Total_quantity;//總商品購買數量
        $each_item=explode('**', $item_info);//切割每一筆商品


        //訂單的商品資料
        for ($i=0; $i <$Total_quantity ; $i++) 
        {
            $each_info=explode('%%', $each_item[$i]);//每筆商品的資訊
            array_push(
                $obj->Send['Items'],
                    array(
                        'Name' =>$each_info[0],
                        'Price' => $each_info[1],
                        'Currency' => $each_info[2], 
                        'Quantity' => $each_info[3], 
                        'URL' => $each_info[4]
                    )
            );
        }
        # 電子發票參數
        /*
        $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
        $obj->SendExtend['RelateNumber'] = "Test".time();
        $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
        $obj->SendExtend['CustomerPhone'] = '0911222333';
        $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
        $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
        $obj->SendExtend['InvoiceItems'] = array();
        // 將商品加入電子發票商品列表陣列
        foreach ($obj->Send['Items'] as $info)
        {
            array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
        }
        $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
        $obj->SendExtend['DelayDay'] = '0';
        $obj->SendExtend['InvType'] = ECPay_InvType::General;
        */
        //產生訂單(auto submit至ECPay)
        $obj->CheckOut();
    } catch (Exception $e) {
    	echo $e->getMessage();
    }

    }

}




