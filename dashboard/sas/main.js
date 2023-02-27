$(document).ready(function(){
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var time = new Date();
    var selectElem = document.getElementById("dates");
    var selected;

    fetchSalesReport(`${months[time.getMonth()]} ${time.getDate()}`);

    //fetch dates
    $.ajax({
        type: 'POST',
        url: './php/fetch_dates.php',
        success: function(res){
            res = JSON.parse(res);
            console.log(res);
            let dates_list = [];
            for (let i = res.length - 1; i >= 0; i--) {
                dates_list.push(res[i]);
            }
            dates_list = [...new Set(dates_list)];
            for (let i = dates_list.length - 1; i >= 0; i--) {
                selectElem.insertAdjacentHTML("afterbegin", `
                <option value="${dates_list[i]}">${dates_list[i]}</option>`);
            }
            selectElem.value = `${months[time.getMonth()]} ${time.getDate()}`;

            $("#dates").on("change", function(){
                selected = document.getElementById("dates").value;
                $("#show").on("click", function(){
                    fetchSalesReport(selected);
                })
            })
        }
    })

    $("#options").on("change", function(){
        alert($(this).val())
    })
    
    function fetchSalesReport(d){
        
        let date;
        if (d.length == 5) {
            date = d.slice(-1);
        } else if (d.length == 6) {
            date = d.slice(-2);
        }
        let mon = d.slice(0, 3);
        var total_daily_sales = 0;
        var playground_daily_report = 0;
        var cafe_daily_report = 0;

        $.ajax({
            type: 'POST',
            url: './php/fetch_daily_sales.php',
            data: {
                date: date,
                mon: mon,
            }, success: function(res){
                let total = 0;
                let play_daily = 0;
                let cafe_daily = 0;
                res = JSON.parse(res);
                //daily sales
                for (let i = 0; i < res[0].length; i++) {
                    total += parseInt(res[0][i])
                }
                total_daily_sales = total;
                //two section daily sales
                for (let i = 0; i < res[0].length; i++) {
                    if (res[1][i] == 'play'){
                        play_daily += parseInt(res[0][i])
                    } else {
                        cafe_daily += parseInt(res[0][i])
                    }
                }
                playground_daily_report = play_daily;
                cafe_daily_report = cafe_daily;
                $("#total-daily-report").html(total_daily_sales);
                $("#playground-daily-report").html(playground_daily_report);
                $("#cafe-daily-report").html(cafe_daily_report);
            }
        }) 
    }
    
    $("#insert-products").on("click", function(){
        window.open("http://localhost/admin/insert.php", "_self");
    })

    $(".side-bar .content button").on("click", function(){
        $.ajax({
            type: 'POST',
            url: './php/fetch_detailed_report.php',
            success: function(res){
                res = JSON.parse(res);
                let total = 0;

                for (let x = 0; x < res.length; x++) {
                    total += parseInt(res[x][4]);
                }
                
                $(".body-content").remove();

                let body = document.getElementById("body");

                let content = '';
                for (let i = 0; i < res.length; i++) {
                    content += `
                    <tr>
                        <td>${res[i][0]}</td>
                        <td>${res[i][1]}</td>
                        <td>${res[i][2]}</td>
                        <td>${res[i][3]}</td>
                        <td>${res[i][4]}</td>
                        <td>${res[i][5]}</td>
                        <td>${res[i][6]}</td>
                        <td>${res[i][7]}</td>
                    </tr>`;
                }

                content = content += `
                <tr>
                    <tr>
                        <td colspan="8" style="text-align:right;font-size: 20px;font-weight:bold;">Total: ${total}</td>
                    </tr>
                </tr>`;
                

                body.insertAdjacentHTML("afterbegin", `
                <div class="detailed-report-wrapper">
                    <table id="table">
                        <tr>
                            <td>ID</td>
                            <td>Section</td>
                            <td>Ticket No.</td>
                            <td>Item</td>
                            <td>Amount</td>
                            <td>Cashier</td>
                            <td>Time</td>
                            <td>Date</td>
                        </tr>
                        ${content}
                    </table>
                </div>`);
                
                console.log(body.innerHTML);
            }
        })
    })
})

