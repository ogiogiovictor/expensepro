function _(x) {
    return document.getElementById(x);
}
function toggleElement(x) {
    var x = _(x);
    if (x.style.display == 'block') {
        x.style.display = 'none';
    } else {
        x.style.display = 'block';
    }
}


function add_row_more() {

    $.ajax({
        url: GLOBALS.appRoot + "action/processmorecode/",
        type: "GET",
        dataType: "JSON"
        , success: function (data) {
            $rowno = $("#employee_table tr").length;
            $rowno = $rowno + 1;
            $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' required name='exDetailofpayment[]' id='exDetailofpayment' placeholder='Payment Details' class='form-control'></td>\n\
                   <td><input type='number' required name='exAmount[]' id='exAmount' placeholder='Amount' class='form-control exAmount'></td>\n\
                   <td><input type='text' required name='exCode[]' id='exCode' placeholder='Code' class='form-control'></td>\n\
                   <td><input type='date' required name='exDate[]' id='exDate' placeholder='yyyy-mm-dd' class='form-control datepicker'></td>\n\
                   <td><input type='button' class='btn btn-xs btn-danger' value='X' onclick=delete_row('row" + $rowno + "')></td></tr>");
            for (var idx = 0; idx < data.ci.length; ++idx) {
                changeStatus += '<option value="' + data.ci[idx].Id + '">' + data.ci[idx].tillName + '-' + data.ci[idx].tillBalance + '</option>';
            }
            changeStatus += '</select>';
            changeStatus += '<button id="processreminder" type="submit" onClick="makepaymentnow(' + assetid + ')" class="btn btn-danger btn-fill btn-sm">Pay</button></form>';
            $('#putoption').html(changeStatus);

        }, error: function (xhr) {
            $('#loaddepdetails').html("<br/>Error Loading content, please try again....");
            $('#loaddepdetails').addClass("errorRed");

        }
    });
}


function add_row()
{

    $rowno = $("#employee_table tr").length;
    $rowno = $rowno + 1;
    $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><input required type='text' name='exDetailofpayment[]' id='exDetailofpayment' placeholder='Payment Details' class='form-control'></td>\n\
<td><input type='number' required name='exAmount[]' id='exAmount' placeholder='Amount' class='form-control exAmount'></td>\n\
<td><select required name='exCode[]' id='exCode' placeholder='Code' class='form-control'><option value=''>Select Code</option><option value='303011016'> ABSA Vessel Finance Facility - 303011016</option><option value='201020112'> Access Bank 2 - 201020112</option><option value='201020110'> Access Bank - 201020110</option><option value='305031018'> ACCRUED INTEREST (5 YRS REDEEM) - 305031018</option><option value='305031027'> Accrued penalty due - 305031027</option><option value='110021040'> Acum Dep Leased Cranes - 110021040</option><option value='110021030'> Acum Dep Leased Marine Equipme - 110021030</option><option value='110021080'> Acum Dep Leased Motor Vehicles - 110021080</option><option value='110021050'> Acum Dep Leased Office Equipme - 110021050</option><option value='110022010'> Acum Dep Owned Buildings - 110022010</option><option value='110022040'> Acum Dep Owned Cranes - 110022040</option><option value='110022070'> Acum Dep Owned Furniture & Fit - 110022070</option><option value='110022080'> Acum Dep Owned Motor Vehicles - 110022080</option><option value='110022050'> Acum Dep Owned Office Equipmen - 110022050</option><option value='110022020'> Acum Dep Owned Plant & Machine - 110022020</option><option value='110022060'> Acum Dep Owned Software - 110022060</option><option value='305041029'>Advance Receipt - 305041029</option><option value='704161010'>Advertising - 704161010</option><option value='408011010'>AFS Fair value reserve - 408011010</option><option value='207041028'>Asset Management Deposit - 207041028</option><option value='704041010'>Auditors Remuneration - 704041010</option><option value='402011010'>Aureos Capital Loan Stock - 402011010</option><option value='305041035'>Aureos Capital - 305041035</option><option value='704141011'>Bandwidth & Other Recurring Co - 704141011</option><option value='602011011'>Bank Credit Interest - 602011011</option><option value='701031011'>Bank Overdrafts (Expense) - 701031011</option><option value='303011019'>Bill payables - 303011019</option><option value='207041018'>Bond Expenses - 207041018</option><option value='703021022'>BUs Expenses(Hertz Payroll) - 703021022</option><option value='703021021'>BUs Expenses(Marine Payroll) - 703021021</option><option value='703021020'>BUs Expenses(Outsourci Payrol) - 703021020</option><option value='703021010'>BUs Operating Exp (Others) - 703021010</option><option value='203011015'> C&I Motors Transit Account - 203011015</option><option value='206011011'>C & I Motors - 206011011</option><option value='202031010'>C&I Motors Ltd - 202031010</option><option value='207041027'>Cheque Exchange 1 - 207041027</option><option value='206011012'>Citrans Global Services Limite - 206011012</option><option value='202011026'>Citrans Investors Receivables - 202011026</option><option value='701021011'>Commercial Notes (Expense) - 701021011</option><option value='302031010'>Commercial Notes (Liability) - 302031010</option><option value='704161012'>Community Development - 704161012</option><option value='704051012'>Consultants Fees Other Charge - 704051012</option><option value='208011010'>Consumables - 208011010</option><option value='207011010'>Consumer Lease in Process - 207011010</option><option value='204011013'>Consumer Lease Receivables - 204011013</option><option value='204011015'>Corp Lease Receivables-HERTZ - 204011015</option><option value='704101016'>Corporate Gifts - 704101016</option><option value='705011010'>Corporate Income Tax - P&L - 705011010</option><option value='307011010'>Corporate Income Tax Payable - 307011010</option><option value='307011011'>Corporate Income Tax-Citrans - 307011011</option><option value='207011011'>Corporate Lease in process - 207011011</option><option value='204011014'>Corporate Lease Receivables - 204011014</option><option value='701010001'>Cost of Sales-Citrack - 701010001</option><option value='804151010'>COTVAT & Other Bank Chgs - 804151010</option><option value='704141012'>Courier Services, Postages & - 704141012</option><option value='303011017'>Creditors-New NLNG Vessels - 303011017</option><option value='112011010'>Deferred income tax assets - 112011010</option><option value='304011010'>Deferred maintenance charge - 304011010</option><option value='305011010'>Deffered Income(Edo State Con) - 305011010</option><option value='305041030'>Deposit By Petrotech Directors - 305041030</option><option value='305041027'>DEPOSIT BY VERDES ENERGY - 305041027</option><option value='207031019'>Deposit for investment - 207031019</option><option value='207041031'>Deposit for new vessel - 207041031</option><option value='893041040'>Deprec Leased Cranes - 893041040</option><option value='893041030'>Deprec Leased Marine Equipment - 893041030</option><option value='893041080'>Deprec Leased Motor Vehicles - 893041080</option><option value='893041050'>Deprec Leased Office Equipment - 893041050</option><option value='893042010'>Deprec Owned Buildings - 893042010</option><option value='893042070'>Deprec Owned Furniture & Fitt - 893042070</option><option value='893042080'>Deprec Owned Motor Vehicles - 893042080</option><option value='893042050'>Deprec Owned Office Equipment - 893042050</option><option value='893042020'>Deprec Owned Plant & Machinery - 893042020</option><option value='893042060'>Deprec Owned Software - 893042060</option><option value='201020218'>Diamond - C&I Petrotech Marine - 201020218</option><option value='201023010'>Diamond - Dom 11 - 201023010</option><option value='201020210'>Diamond - Salary NGN - 201020210</option><option value='201020219'>Diamond – Webpay - 201020219</option><option value='201023014'>Diamond Bank - FCY Dom - 201023014</option><option value='201020216'>Diamond Bank-C&I DSRA Account - 201020216</option><option value='201020217'>Diamond Bank-C&I Specia Marine - 201020217</option><option value='201020212'>Diamond Bank-Cadbury- 201020212</option><option value='201023012'>Diamond Bank-Epic Dom- 201023012</option><option value='201020213'>Diamond Bank-Fin. Services- 201020213</option><option value='201020215'>Diamond Bank-Online Salary Pmt- 201020215</option><option value='201023013'>Diamond Dom C&I Special Marines- 201023013</option><option value='201023011'>Diamond –Dom- 201023011</option><option value='201020211'>Diamond main NGN- 201020211</option><option value='704011010'>Directors Fees - 704011010</option><option value='704011011'>Directors Sitting Allowance - 704011011</option><option value='704101017'>Donations - 704101017</option><option value='201020310'>Eco bank ( Ecoselect) - 201020310</option><option value='201023110'>Eco bank (Dom) - 201023110</option><option value='201020311'>Eco bank (Naira) - 201020311</option><option value='204011010'>Edo State Contract Receivables - 204011010</option><option value='705021010'>Education Tax - P&L - 705021010</option><option value='704191010'>Electricity - 704191010</option><option value='704031013'>Entertainment and Meetings - 704031013</option><option value='407011010'>Exchange equalisation reserve - 407011010</option><option value='100011090'>FA Lease Household Equipment - 100011090</option><option value='100011040'>FA Leased Cranes - 100011040</option><option value='100011030'>FA Leased Marine Equipment - 100011030</option><option value='100011080'>FA Leased Motor Vehicles - 100011080</option><option value='100011050'>FA Leased Office Equipment - 100011050</option><option value='100012010'>FA Owned Buildings - 100012010</option><option value='100012070'>FA Owned Furniture & Fitt - 100012070</option><option value='100012000'>FA Owned Land - 100012000</option><option value='100012080'>FA Owned Motor Vehicles - 100012080</option><option value='100012050'>FA Owned Office Equipment - 100012050</option><option value='100012020'>FA Owned Plant & Machinery - 100012020</option><option value='201020610'>FCMB Bank –Salary - 201020610</option><option value='201020616'>FCMB- C&I Hertz - 201020616</option><option value='201020611'>FCMB-APG ACCOUNT- 201020611</option><option value='201023413'>FCMB-Citrans Telematics Dom - 201023413</option><option value='201020615'>FCMB-Citrans Telematics - 201020615</option><option value='201020613'>FCMB-Petrotech Marine - 201020613</option><option value='201020410'>FIDELITY - Collection Account - 201020410</option><option value='201023210'>FIDELITY - Dom Account - 201023210</option><option value='201020411'>FIDELITY - Loan Account - 201020411</option><option value='201020412'>FIDELITY - Main Account - 201020412</option><option value='201023310'>FIRST BANK – Dom - 201023310</option><option value='201020511'>FIRST BANK - Facility Ac (PHC) - 201020511</option><option value='201020510'>FIRST BANK - Naira (Keffi) - 201020510</option><option value='201020512'>FIRST BANK - Naira (Lekki) - 201020512</option><option value='201020515'>FIRST BANK - PHC Artillary Acc - 201020515</option><option value='201020614'>First City Monument Bank ABSA - 201020614</option><option value='201023410'>First City Monument Bank Dom - 201023410</option><option value='201023412'>First city monument bank DSRA - 201023412</option><option value='201020612'>First CITY monument bank tag 1 - 201020612</option><option value='207041032'>Fixed Asset Disposal A/c-New - 207041032</option><option value='207041010'>Fixed assets disposal account- 207041010</option><option value='302041010'>Fixed Rate 5yr Redeemable Bond- 302041010</option><option value='303011012'>Foregin Payables- 303011012</option><option value='901011010'>Foreign Exchange Loss/Gain- 901011010</option><option value='603011014'>Franked Investment Income- 603011014</option><option value='201021513'>FSDH- C&I Leasing Bond 2 DSRA- 201021513</option><option value='201021512'>FSDH- C&I Leasing DSRA- 201021512</option><option value='201021510'>FSDH-Current Account- 201021510</option><option value='201021511'>FSDH-Sinking Fund Account- 201021511</option><option value='703031015'>Fuel Expenses (Leased Assets)- 703031015</option><option value='704211011'>Fuel Expenses (Own Assets)- 704211011</option><option value='704211017'>Fuel expenses- 704211017</option><option value='207041030'>FX Account- 207041030</option><option value='406011010'>General reserve- 406011010</option><option value='208011011'>Goods in trnsit (G.I.T)- 208011011</option><option value='704111010'>Govt Levies- 704111010</option><option value='201020711'>GTB CALL ACCOUNT- 201020711</option><option value='201020710'>Guaranty Trust bank- 201020710</option><option value='201021910'>Heritage Bank- 201021910</option><option value='704101011'>Hertz Franchise- 704101011</option><option value='204011011'>Ikpoba Okha Contract Receivabl- 204011011</option><option value='601011015'>Income on chartered vessels- 601011015</option><option value='703051012'>Insurance Expense (Lease Asset)- 703051012</option><option value='603011012'>Insurance Inc-Claims & Refund- 603011012</option><option value='603011013'>Insurance income (Finance leas) - 603011013</option><option value='207041013'>Insurance Receiva - 207041013</option><option value='703051010'>Insurance-Public Liability & P - 703051010</option><option value='703051011'>Insurance-Workmen Compensation - 703051011</option><option value='701011016'>Int on Lease from Stanbic IBTC - 701011016</option><option value='701011013'>Int on Leases from Access Bank - 701011013</option><option value='701011014'>Int on Leases from Fidelity - 701011014</option><option value='701011012'>Int on Leases from First Bank - 701011012</option><option value='202031015'>Intercompany Account - 202031015</option><option value='701011015'>Interest on Lease from Diamond - 701011015</option><option value='701011017'>Interest on Leases from FCMB - 701011017</option><option value='701011025'>Interest on Leases from FDC - 701011025</option><option value='701011011'>Interest on Leases from UBA - 701011011</option><option value='701011021'>INTEREST ON REDEEMABLE BOND - 701011021</option><option value='704081010'>Inventory Losses/Write Offs - 704081010</option><option value='208021010'>Inventory- 208021010</option><option value='206011015'>Investment In Epic- 206011015</option><option value='602011012'>Investment Income- 602011012</option><option value='201021810'>Keystone Bank- 201021810</option><option value='302021024'>Lease Notes Investment- 302021024</option><option value='202021020'>Lease rental due(Consumer)-Finl- 202021020</option><option value='202021021'>Lease rental due(Corporate)-Fi- 202021021</option><option value='202021022'>Lease rental due(Corporate)-HE- 202021022</option><option value='206011010'>Leaseafric Ghana- 206011010</option><option value='302021023'>LEASES FROM BANK- ZENITH BANK- 302021023</option><option value='302021013'>LEASES FROM BANK-ACCESS BANK- 302021013</option><option value='302021014'>LEASES FROM BANK-DIAMOND BANK- 302021014</option><option value='302011011'>LEASES FROM BANK-FCMB- 302011011</option><option value='302021025'>LEASES FROM BANK-FDC - 302021025</option><option value='302011010'>LEASES FROM BANK-FIDELITY BANK - 302011010</option><option value='302021012'>LEASES FROM BANK-FIRST BANK - 302021012</option><option value='302021015'>LEASES FROM BANK-STANBIC IBTC - 302021015</option><option value='704051010'>Legal Charges - 704051010</option><option value='205021010'>Less Prov Dim LngTrm Asset Val - 205021010</option><option value='207071010'>Less Prov for Doubtful Debtors - 207071010</option><option value='204021013'>Less: Prov. For Dbtful Debt (C) - 204021013</option><option value='202011024'>Less: Prov. For Dbtful Debt (L) - 202011024</option><option value='204021018'>Less: Unearned Int.(Consumer) - 204021018</option><option value='204021019'>Less: Unearned Int.(Corporate) - 204021019</option><option value='204021020'>Less: Unearned Service charge - 204021020</option><option value='202021018'>Less:Prov. On Lease Rental Due - 202021018</option><option value='202011025'>Loan To Epic - 202011025</option><option value='303011011'>Local Payables - 303011011</option><option value='704031010'>Local Transportation - 704031010</option><option value='704211010'>Maintenance Expenses - Auto (O) - 704211010</option><option value='704211013'>Maintenance Expenses - F & F - 704211013</option><option value='704211015'>Maintenance Expenses - L & B - 704211015</option><option value='704211012'>Maintenance Expenses - Off. Eq - 704211012</option><option value='704211014'>Maintenance Expenses - P & M - 704211014</option> <option value='703031014'>Maintenance Expenses (Lease As) - 703031014</option> <option value='704211019'>Maintenance expenses - 704211019</option><option value='207031018'>Marine platform receivables - 207031018</option><option value='704121011'>Medicals - 704121011</option><option value='704181017'>Misc. Office Expenses - 704181017</option><option value='701011023'>Miscellaneous funding cost - 701011023</option><option value='601011011'>Miscellanous Income - 601011011</option><option value='703021032'>NCD Charges - 703021032</option><option value='305041015'>Net salary payable - 305041015</option><option value='704181016'>Newspapers & Magazines - 704181016</option><option value='305041017'>NHF - 305041017</option><option value='201023510'>NIB (Citi) – Dom - 201023510</option><option value='201020810'>NIB (Citi) – Naira - 201020810</option><option value='704181010'>Office Security - 704181010</option><option value='401011010'>Ordinary Share Capital - 401011010</option><option value='207041025'>OTHER ACCOUNT RECEIVABLES - 207041025</option><option value='305041034'>Other credit balances - 305041034</option><option value='704111011'>Other Levies - 704111011</option><option value='207011014'>Other prepayment - 207011014</option><option value='704051011'>Other Professional Exps - 704051011</option><option value='207041023'>Other receivables - 207041023</option><option value='704181011'>Other Security Services - 704181011</option><option value='601011014'>Outsourcing Turnover - 601011014</option><option value='704031012'>Oversea Travel - 704031012</option><option value='203011014'>Provision for doubtful debts - 203011014</option><option value='305041016'>P A Y E - 305041016</option><option value='704111012'>Penalties- 704111012</option><option value='704121017'>Pension Funds - Company Contri- 704121017</option><option value='306011010'>Pension Funds- 306011010</option> <option value='201020107'>Petty Cash – Calabar - 201020107</option> <option value='201020106'>Petty Cash – Enugu - 201020106</option> <option value='201011050'>Petty Cash - Fuel Cards - 201011050</option> <option value='201024102'>Petty Cash – GE - 201024102</option><option value='201020101'>Petty Cash - Head Office - 201020101</option><option value='201020102'>Petty Cash - Hertz Lagos - 201020102</option><option value='201020109'>Petty Cash - Marine Office - 201020109</option><option value='201020103'>Petty Cash - Mushin Lagos - 201020103</option><option value='201024101'>Petty Cash – SDS - 201024101</option><option value='201024103'>Petty Cash – Stanbic - 201024103</option><option value='201020105'>Petty Cash – Warri - 201020105</option><option value='201020108'>PETTY CASH PHC - 201020108</option><option value='201020100'>Petty Cash-Naira - 201020100</option><option value='201011056'>Petty Cash-SPDC - 201011056</option><option value='204011016'>Philips Global Receivables - 204011016</option><option value='207041026'>Prepaid consultancy fee - 207041026</option><option value='207011012'>Prepaid Rent – Office - 207011012</option><option value='704171010'>Printing & Stationery - 704171010</option><option value='601011017'>Profit/Los on Fixe Asset Disp - 601011017</option><option value='400012010'>Profit/Loss - 400012010</option><option value='893043010'>Prov doubtfu debt-other asset - 893043010</option><option value='305031024'>Prov for Carbotage fee - 305031024</option><option value='305031023'>Prov for foreign exchange loss - 305031023</option><option value='305031026'>Prov for Import Duties - 305031026</option><option value='305031025'>Prov for NCDF Fee - 305031025</option><option value='893043012'>Prov. Bad and Dooutful Debt- 893043012</option><option value='893043011'>Prov. bad debt-Lease renta due- 893043011</option><option value='893043014'>Prov. For Merger loss- 893043014</option><option value='305031021'>Provision For accrued interest- 305031021</option><option value='305031011'>Provision For Auditors- 305031011</option><option value='305031014'>Provision For Directors Fees- 305031014</option><option value='305031016'>Provision For Group life Insur- 305031016</option><option value='305041010'>Provision for Hertz Franchise- 305041010</option><option value='305031015'>Provision For Insurance ( Asse)- 305031015</option><option value='305031010'>Provision for Medicals- 305031010</option><option value='305031028'>Provision for merger loss- 305031028</option><option value='305031017'>Provision For Staff Performanc - 305031017</option><option value='704181015'>Provisions & Toiletories - 704181015</option><option value='704181015'>Provisions & Toiletories - 704181015</option><option value='704161011'>Public Relations- 704161011</option><option value='701010000'>Purchases- 701010000</option><option value='303011014'>PZ Payable Account- 303011014</option><option value='203011011'>Receivables- 203011011</option><option value='704021010'>Rent – Office- 704021010</option><option value='704211016'>Repairs & Renewals- 704211016</option><option value='409011010'>Revaluation reserve- 409011010</option><option value='601011010'>Sales Turnover- 601011010</option><option value='305071010'>Sales Vat - Vat Payable- 305071010</option><option value='201020910'>SCB- 201020910</option><option value='201023910'>SCB-Dom- 201023910</option><option value='701021010'>Secured Lease Notes (Expense)- 701021010</option><option value='302051010'>Secured Lease Notes (Liability)- 302051010</option><option value='704061011'>Securities and Exchange Commis- 704061011</option><option value='305011011'>Security Deposit- 305011011</option><option value='403011010'>Share Premium- 403011010</option><option value='205011012'>Short Term Investment – Diamon- 205011012</option><option value='205011011'>Short Term Investment – FBN- 205011011</option><option value='205011013'>Short Term Investment – Fideli- 205011013</option><option value='205011015'>Short-term Investment – FSDH- 205011015</option><option value='704051013'>Software Acquisition cost- 704051013</option><option value='704211020'>Software Maintenance Costs- 704211020</option><option value='202011021'>Staff Advances- 202011021</option><option value='305041023'>Staff Cooperative Deduction- 305041023</option><option value='305041022'>Staff Cooperative loans- 305041022</option><option value='704121016'>Staff Performance Bonus- 704121016</option><option value='207041015'>Staff shares receivables- 207041015</option><option value='704121018'>Staff Training & Development- 704121018</option><option value='201021012'>Stanbic Facility Account- 201021012</option><option value='201021010'>Stanbic IBTC –Hmia- 201021010</option><option value='201021011'>Stanbic Salary- 201021011</option><option value='704171011'>Stationery- 704171011</option><option value='405011010'>Statutory credit reserve- 405011010</option><option value='404011010'>Statutory Reserve- 404011010</option><option value='201023710'>Sterling Bank – GBP- 201023710</option><option value='201023711'>Sterling Bank –Dom- 201023711</option><option value='201021110'>Sterling Bank –naira- 201021110</option><option value='704181014'>Stored Diesel & Fuel Supply- 704181014</option><option value='704101013'>Subscription- 704101013</option><option value='704101014'>Subscription- 704101014</option><option value='704141010'>Telephone & Telefaxes- 704141010</option><option value='704181012'>Toll Fare- 704181012</option><option value='601011018'>Tracking Income- 601011018</option><option value='202011017'>Transaction Based Company Ltd- 202011017</option><option value='704031011'>Travels & Accommodation- 704031011</option><option value='204021017'>Unearned Insurance Income- 204021017</option><option value='204021014'>Unearned Management fees- 204021014</option><option value='204021016'>Unearned Purchase Option- 204021016</option><option value='201021610'>Union Bank- 201021610</option><option value='201021611'>Union Bank-Citrans Telematics- 201021611</option><option value='305041019'>Union Dues- Nupeng- 305041019</option><option value='201021210'>United Bank for African- 201021210</option><option value='201021620'>Unity Bank- 201021620</option><option value='207051020'>VAT Receivables- 207051020</option><option value='704121010'>Wages & Salaries- 704121010</option><option value='207041021'>WAP- 207041021</option><option value='704181013'>Water Supply- 704181013</option><option value='201021310'>Wema bank Plc- 201021310</option><option value='203011012'>WHT Receivables- 203011012</option><option value='207051010'>Witholding Taxes Payable- 207051010</option><option value='207041014'>Witholding Taxes Receivable- 207041014</option><option value='201021424'>ZENITH- C & I Special Account- 201021424</option><option value='201023810'>ZENITH– Dom- 201023810</option><option value='201021411'>ZENITH– Hertz- 201021411</option><option value='201021410'>ZENITH- Lease Note Account - 201021410</option><option value='201021412'>ZENITH- Leased Note Collectio - 201021412</option><option value='201021414'>ZENITH– Outsourcing - 201021414</option><option value='201021423'>ZENITH- Petrotech NGN - 201021423</option><option value='201021422'>ZENITH-C&I Hertz Open Rental - 201021422</option><option value='201021421'>ZENITH-C&I NLNG Account - 201021421</option><option value='201021415'>ZENITH-Main Account - 201021415</option><option value='201021417'>ZENITH-Port Harcourt - 201021417</option><option value='201021416'>ZENITH-PZ Account - 201021416</option><option value='201021420'>ZENITH-Suzuki Driving School - 201021420</option><option value='201021419'>ZENITH–Warri - 201021419</option></select></td>\n\
<td><input type='date' required name='exDate[]' id='exDate' placeholder='dddd-mm-dd' class='form-control'></td>\n\
<td><input type='button' class='btn btn-xs btn-danger' value='X' onclick=delete_row('row" + $rowno + "')></td></tr>");


}


function delete_row(rowno)
{
   var r = confirm("Please make sure this particular row you want to remove all details, eg. Payment details, amount, select code and date is empty before your remove");
    if (r == true) {
      $('#' + rowno).remove(); 
   }
     
    //$('#' + rowno).remove();
    
    //setTimeout(function(){ window.location.reload(1); });
}

//function that post data from php or node js script to the database
// accepts 8 parameters 
function postDataVal(type, url, data, dataType, processCallbackData, Errorlog, context, complete) {
    var type; // GET, POST
    var url;
    var data; // The POST data in a JSON object or string i.e { name: "John", // time: "2pm" }
    var dataType; // JSON, XML, HTML, TEXT
    var processCallbackData;
    var Errorlog;

    $.ajax({
        type: type,
        url: url,
        data: data,
        dataType: dataType,
        success: processCallbackData,
        error: Errorlog,
        context: context, //This uses an element as its this reference
        complete: complete
    });

    return;
}

function isArray(o) {
    return Object.prototype.toString.call(o) === '[object Array]';
}

function logMsg(text) {
    // This function is used for logging.
    if (text[text.length - 1] === '\n') {
        text = text.substring(0, text.length - 1);
    }
    if (window.performance) {
        var now = (window.performance.now() / 1000).toFixed(3);
        console.log(now + ': ' + text);
    } else {
        console.log(text);
    }
}

function vaildEmail(Email) {
    var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    return $.trim(Email).match(pattern) ? true : false;
}

function validateEmail(sEmail) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) {
        return true;
    } else {
        return false;
    }
}


function numberToEnglish(n, custom_join_character) {

    var string = n.toString(),
        units, tens, scales, start, end, chunks, chunksLen, chunk, ints, i, word, words;

    var and = custom_join_character || 'and';

    /* Is number zero? */
    if (parseInt(string) === 0) {
        return 'zero';
    }

    /* Array of units as words */
    units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

    /* Array of tens as words */
    tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    /* Array of scales as words */
    scales = ['', 'Thousand', 'Million', 'Billion', 'Trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quatttuor-decillion', 'quindecillion', 'sexdecillion', 'septen-decillion', 'octodecillion', 'novemdecillion', 'vigintillion', 'centillion'];

    /* Split user arguemnt into 3 digit chunks from right to left */
    start = string.length;
    chunks = [];
    while (start > 0) {
        end = start;
        chunks.push(string.slice((start = Math.max(0, start - 3)), end));
    }

    /* Check if function has enough scale words to be able to stringify the user argument */
    chunksLen = chunks.length;
    if (chunksLen > scales.length) {
        return '';
    }

    /* Stringify each integer in each chunk */
    words = [];
    for (i = 0; i < chunksLen; i++) {

        chunk = parseInt(chunks[i]);

        if (chunk) {

            /* Split chunk into array of individual integers */
            ints = chunks[i].split('').reverse().map(parseFloat);

            /* If tens integer is 1, i.e. 10, then add 10 to units integer */
            if (ints[1] === 1) {
                ints[0] += 10;
            }

            /* Add scale word if chunk is not zero and array item exists */
            if ((word = scales[i])) {
                words.push(word);
            }

            /* Add unit word if array item exists */
            if ((word = units[ints[0]])) {
                words.push(word);
            }

            /* Add tens word if array item exists */
            if ((word = tens[ints[1]])) {
                words.push(word);
            }

            /* Add 'and' string after units or tens integer if: */
            if (ints[0] || ints[1]) {

                /* Chunk has a hundreds integer or chunk is the first of multiple chunks */
                if (ints[2] || !i && chunksLen) {
                    words.push(and);
                }

            }

            /* Add hundreds word if array item exists */
            if ((word = units[ints[2]])) {
                words.push(word + ' hundred');
            }

        }

    }

    return words.reverse().join(' ');

}


function numToWords(number) {

    //Validates the number input and makes it a string
    if (typeof number === 'string') {
        number = parseInt(number, 10);
    }
    if (typeof number === 'number' && isFinite(number)) {
        number = number.toString(10);
    } else {
        return 'This is not a valid number';
    }

    //Creates an array with the number's digits and
    //adds the necessary amount of 0 to make it fully 
    //divisible by 3
    var digits = number.split('');
    while (digits.length % 3 !== 0) {
        digits.unshift('0');
    }


    //Groups the digits in groups of three
    var digitsGroup = [];
    var numberOfGroups = digits.length / 3;
    for (var i = 0; i < numberOfGroups; i++) {
        digitsGroup[i] = digits.splice(0, 3);
    }
    console.log(digitsGroup); //debug

    //Change the group's numerical values to text
    var digitsGroupLen = digitsGroup.length;
    var numTxt = [
        [null, 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'], //hundreds
        [null, 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'], //tens
        [null, 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'] //ones
        ];
    var tenthsDifferent = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

    // j maps the groups in the digitsGroup
    // k maps the element's position in the group to the numTxt equivalent
    // k values: 0 = hundreds, 1 = tens, 2 = ones
    for (var j = 0; j < digitsGroupLen; j++) {
        for (var k = 0; k < 3; k++) {
            var currentValue = digitsGroup[j][k];
            digitsGroup[j][k] = numTxt[k][currentValue];
            if (k === 0 && currentValue !== '0') { // !==0 avoids creating a string "null hundred"
                digitsGroup[j][k] += ' hundred ';
            } else if (k === 1 && currentValue === '1') { //Changes the value in the tens place and erases the value in the ones place
                digitsGroup[j][k] = tenthsDifferent[digitsGroup[j][2]];
                digitsGroup[j][2] = 0; //Sets to null. Because it sets the next k to be evaluated, setting this to null doesn't work.
            }
        }
    }

    console.log(digitsGroup); //debug

    //Adds '-' for gramar, cleans all null values, joins the group's elements into a string
    for (var l = 0; l < digitsGroupLen; l++) {
        if (digitsGroup[l][1] && digitsGroup[l][2]) {
            digitsGroup[l][1] += '-';
        }
        digitsGroup[l].filter(function (e) {return e !== null});
        digitsGroup[l] = digitsGroup[l].join('');
    }

    console.log(digitsGroup); //debug

    //Adds thousand, millions, billion and etc to the respective string.
    var posfix = [null, 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion'];
    if (digitsGroupLen > 1) {
        var posfixRange = posfix.splice(0, digitsGroupLen).reverse();
        for (var m = 0; m < digitsGroupLen - 1; m++) { //'-1' prevents adding a null posfix to the last group
            if (digitsGroup[m]) {
                digitsGroup[m] += ' ' + posfixRange[m];
            }
        }
    }

    console.log(digitsGroup); //debug

    //Joins all the string into one and returns it
    return digitsGroup.join(' ');

} //End of numToWords function



//Function popup to be removed later
function PopUp(hideOrshow) {
    if (hideOrshow == 'hide') {
        //document.getElementById('ac-wrapper').style.display = "none";
        //$('#ac-wrapper').style.display = "none";
        $('#ac-wrapper').hide();
    }else {
        //document.getElementById('ac-wrapper').removeAttribute('style');
       $('#ac-wrapper').removeAttr('style');
    }
}
/*
window.onload = function () {
    setTimeout(function () {
        PopUp('show');
    }, 500);
}
*/