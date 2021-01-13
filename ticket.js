function on_load()
{
    movie_name=document.getElementById("moviename");
    movie_name.innerHTML += localStorage.getItem('movie');
    var theatre=document.getElementById("theatre");
    theatre.innerHTML+=localStorage.getItem('theatre_name');
    var date=document.getElementById("date");
    date.innerHTML+=localStorage.getItem('dateandtime');
    seats=document.getElementById("seats");
    seats.innerHTML+=localStorage.getItem('selected');
    
    var bill=document.getElementById("bill");
    var Taxes=document.getElementById("Tax");
    var Inter_Fee = document.getElementById("inter_fee");
    var Discount = document.getElementById("discount");
    var bill_amount = (parseInt(localStorage.getItem('bill')));
    
    if(localStorage.getItem("Tax_Fee") === null) 
        localStorage.setItem("Tax_Fee", "30");
    bill_amount += parseInt(localStorage.getItem("Tax_Fee"));
    Taxes.innerHTML += String.fromCharCode(8377) + localStorage.getItem("Tax_Fee");
    
    if (localStorage.getItem("Inter_Fee") === null)
        localStorage.setItem("Inter_Fee","50");
    bill_amount += parseInt(localStorage.getItem("Inter_Fee"));
    Inter_Fee.innerHTML += String.fromCharCode(8377) + localStorage.getItem("Inter_Fee"); 
    
    if (localStorage.getItem("discount") === null)
        localStorage.setItem("discount","0");
    bill_amount -= parseInt(localStorage.getItem("discount"));
    Discount.innerHTML += String.fromCharCode(8377) + parseInt(localStorage.getItem("discount"));

    bill_amount = Math.max(0,bill_amount);
    bill.innerHTML += String.fromCharCode(8377) + bill_amount; 
    console.log(bill_amount);
    localStorage.setItem("bill_amount", bill_amount.toString());

    var userid=document.getElementById('blackie');
    userid.style.color="White";
    userid.innerHTML+=localStorage.getItem('Usermail');
    userid.style.textAlign="center";
}
function next_page()
{
    var movie_data=movie_name.innerHTML;
    var seats_data=seats.innerHTML;
    var usermail=localStorage.getItem('Usermail');
    var dateandtime = localStorage.getItem('dateandtime');
    var theatre_name = localStorage.getItem('theatre_name');
    document.location.href="editdata.php?moviename="+movie_data+"&seats="+seats_data+"&usermail="+usermail+"&theatre_name="+theatre_name+"&dateandtime="+dateandtime;
    localStorage.setItem('userid',localStorage.getItem('Usermail'));
}

function discounts()
{
    var code = document.getElementById("dis_code").value;
    Codes = 
    {
        "OFF10" : 100,
        "HELLO20" : 150,
        "SUPER30" : 200,
        "OFF500" : 500
    };
    if(!(code in Codes))
    {
        alert("Invalid Discount Code");
    }
    else 
    {
        var discount = Codes[code]; 
        localStorage.setItem("discount", discount.toString());
        location.reload();
    }
}
