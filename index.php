<?php
$data=new \PDO("sqlite:Shop.sqlite");
$sql=$data->query('SELECT * FROM invoices INNER JOIN invoice_items ON invoices.InvoiceId=invoice_items.InvoiceId ORDER BY BillingCountry');
$sum=0;
$max=0;
$billcountry="";
$country="";
while($row=$sql->fetch(\PDO::FETCH_ASSOC)){
    if($billcountry===""){
        $billcountry=$row['BillingCountry'];
        $sum+=$row['UnitPrice'];
    }
    elseif($billcountry!=$row['BillingCountry']){
        if($sum>$max){
            $max=$sum;
            $country=$billcountry;}
        $sum=0;
        $sum+=$row['UnitPrice'];
        $billcountry=$row['BillingCountry'];
    }
    else
        $sum+=$row['UnitPrice'];
}
echo "Top Invoicing Country is ".$country." With invoices value: ".$max;
?>