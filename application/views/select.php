<div id="ticketInfo">
    <h1>Ticket Purchase Info</h1>
    <div>Show Title: <?php echo $showTitle; ?></div>
    <div>Show Seat #: <?php echo $seatID; ?></div>
    <div>Theater Name: <?php echo $name; ?></div>
    <div>Theater Address: <?php echo $address; ?></div>
    <div>Show Date: <?php echo $date; ?></div>
    <div>Show Time: <?php echo $time; ?></div>
    <div>Price: $5.99</div>
</div>
<div id="ticketDescription">
    <div>*Please check the movie, date, show time and ticket information listed above is correct.</div><br>
    <div>*Please enter your payment details, double check your credit card information is correct, and click the PURCHASE NOW button below to process your transaction.</div>
</div>
<div id="messageDiv">Enter Your Payment Info</div>
<form action="/main/purchaseTicket/" id="creditForm" method="post">
    <input type="hidden" name="showID" value="<?php echo $showID; ?>">
    <input type="hidden" name="seatID" value="<?php echo $seatID; ?>">
    <div id="formTable">
        <table>
            <tr>
                <td>First name:</td>
                <td><input type="text" id="firstname" name="firstname"></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><input type="text" id="lastname" name="lastname"></td>
            </tr>
            <tr>
                <td>Credit Card Number:</td>
                <td><input type="text" id="creditcard" name="creditcard"></td>
            </tr>
            <tr>
                <td>Expiration Date (MM/YY):</td>
                <td>
                    <select id="month" name="month">
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                    <select id="year" name="year">
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div id="buttonDiv">
        <input id="submitBtn" type="button" value="Submit"/>
        <div class="line-separator"></div>
        <a class="button" href="/">Cancel Ticket</a>
        <a class="button" href="/main/getSeats/<?php echo$showID?>">Change Seat</a>
    </div>
</form>