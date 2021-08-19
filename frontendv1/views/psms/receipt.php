<div class="ticket">
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-center"><b><br/>Start of Legal Receipt</b></div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="frontend/web/logo/img.png" width="200px" height="200px">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <address style="alignment: center">
                <br/>' . $company->name . '<br/>

            </address>
        </div>
    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-center"><b>' . $company->address . '</b></div>
    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-right"><b>MOBILE: ' . $company->contact_person . '</b></div>

    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 "><b>TIN: ' . $company->tin . '</b></div>

    </div>
    <hr/>
    <div class="row">

        <div class = "col-md-12 col-sm-12 col-xs-12 "><b>VRN: ' . $company->vrn . '</b></div>
    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-right"><b>SERIAL NO: ' . $company->serial_number . '</b></div>

    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-right"><b>UIN: ' . $company->uin . '</b></div>

    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-right"><b>TAX OFFICE: ' . $company->tax_office . '</b></div>

    </div>
    <hr/>
    <div class="row">

        <div class = "col-md-12 col-sm-12 col-xs-12 "><b>RECEIPT NO: ' . $RCTNUM . '</b></div>
    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-right"><b>Z NUMBER: ' . $RCTNUM . '/' . $znum . '</b></div>

    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-right"><b>RECEIPT DATE: ' . $current_date . '</b></div>

    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-right"><b>RECEIPT TIME: ' . $current_time . '</b></div>

    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 text-right">
            PUMP #: ' . $sales->pump_no . '
            NOZZEL #: ' . $sales->nozzel_no . '

        </div>
        <hr/>
    </div>

    <div class="row">

        <div class="col-md-6 col-sm-12 col-xs-12 text-right">
            UNLEADED: ' . $sales->volume . ' x ' . $sales->price . '
            ' . Yii::$app->formatter->asDecimal($sales->total, 2) . '
        </div>
        <hr/>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 text-right">
            SUB TOTAL:
            ' . Yii::$app->formatter->asDecimal($sales->sub_total, 2) . '

        </div>
        <hr/>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 text-right">
            TAX :
            ' . Yii::$app->formatter->asDecimal($sales->tax, 2) . '

        </div>
        <hr/>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 text-right">
            TOTAL:

            ' . Yii::$app->formatter->asDecimal($sales->total, 2) . '

        </div>
        <hr/>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            RECEIPT VERIFICATION CODE <br/>
            ' . $fiscal_code . '
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
            <img src="' . $qrCode->writeDataUri() . '">
        </div>
    </div>
    <div class="row">
        <div class = "col-md-12 col-sm-12 col-xs-12 text-center"><b><br/>End of Legal Receipt</b></div>
    </div>
</div>