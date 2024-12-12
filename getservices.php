<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<?php
$service = $_GET['service'] ?? header('Location: ads.php') && exit;

include 'links.php';
include 'nav.php';
include '../app/db.php';
include 'session.php';
include 'sessionstrict.php';


$result = $conn->query("SELECT * FROM services WHERE id = $service");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $service_name = $row['title'];
    $service_price = $row['price'];
    $price_type =  $row['price_type'];
    $calendar = $row['calendar'];
    $description = $row['description'];
} else {
    header('Location: ads.php');
    exit;
}
?>
<div class="container">
    <div class="row mt-2">
        <?php 
        if(isset($_GET['error'])){
                echo '<div class="alert alert-danger" role="alert">One of the dates you selected are not available, Maybe you have already bought this date?</div>';
        }
        ?>
    </div>
    <div class="row mt-2 g-3">

        <div class="col-lg-4 sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Service Details</h4>
                </div>
                <div class="card-body">
                    <div class="card h-100">
                        <img src="img/ad2.png" class="card-img-top" alt="Highlighted Coin Image">

                        <div class="card-body">
                            <h4 class="card-title text-primary"><?php echo $service_name; ?></h4>
                            <?php echo $description ?>
                            <h3 class="text-center">$<?php echo $service_price; ?><small><?php if(isset($price_type) && $price_type == 2){ echo '/lifetime'; } else { echo '/day'; } ?></small></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($_GET['service']) && $calendar == 2){ ?>
        <div class="col-lg-8 sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Coin Details:</h4>
                </div>
                <div class="card-body">
                    <h5>Select a Coin to Apply:</h5>
                    <form action="process_reservation.php" id="reservationForm" method="POST">
                        <select id="productName" style="width: 50%;" required name="coinid">
                            <?php
        $sql = "SELECT name, coin_id FROM coins";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['coin_id'].'">'.$row['name'].'</option>';
                 }
        }
    ?>
                        </select>
                        <a href="">Coin Not Present? Submit Your Coin for free!</a>
                        <br><br>
                        <p>The tiers are selected on basis of Authenticity level of your provided Proof</p>
                        <span>Tier 1:</span>
                        <span class="badge text-bg-light"><i class="bi bi-fingerprint"></i> KYC</span>
                        <span>Tier 2:</span>
                        <span class="badge text-bg-primary"><i class="bi bi-fingerprint"></i> KYC</span>
                        <span>Tier 3:</span>
                        <span class="badge bg-warning text-dark"><i class="bi bi-fingerprint"></i> KYC</span>
                        <h4 class="mt-3">Contact Details (Secured)</h4>
                        <div class="form-group">
                            <div class="row mt-2">
                                <div class="col p-2">
                                    <label for="floatingInputName">Name:</label>
                                    <input required type="text" name="nameinput" class="form-control" id="floatingInputName" placeholder="Satoshi Nakamoto">
                                </div>
                                <div class="col p-2">
                                    <label for="floatingInput">Email:</label>
                                    <input required type="email" name="emailinput" class="form-control" id="floatingInput" placeholder="satoshi@nakamoto.com">
                                </div>
                            </div>
                            
                        </div>

                        <h4 class="mt-3">Billing:</h4>
                        <table class="table">
                            <thead>
                                <th>Service Name</th>
                                <th>Price</th>
                            </thead>
                            <tr>
                                <td><?php echo $service_name; ?> </td>
                                <td>$<?php echo $service_price ?></td>
                            </tr>
                        </table>
                        <input type="hidden" name="submit">
                        <input type="hidden" name="total" value="<?php echo $service_price; ?>">
                        <input type="hidden" name="adtype" value="<?php echo $service; ?>">
                        <button class="btn btn-success" style="width: 100%;" type="submit">Pay & Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php } else {?>

<div class="col-lg-4 sm-12">
    <div class="card">
        <div class="card-header">
            <h4>Select Dates</h4>
        </div>
        <div class="card-body">
            <div>
                <div id="datepicker"></div>
                <br>
                <div class="pillcontainer">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 sm-12">
    <div class="card">
        <div class="card-header">
            <h4>Summary</h4>
        </div>
        <div class="card-body">
            <table class="table " style="border-radius: 2px !important;">
                <thead>
                    <th>#</th>
                    <th>Date</th>
                    <th>Price</th>
                </thead>
                <tr>

                </tr>
            </table>
            <h4>Bill:</h4>
            <table class="table">

                <tr>
                    <td>Subtotal</td>
                    <td id="subtotal">$0.00</td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td><span id="discount" class="badge text-bg-success">$0.00</span></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><strong id="total">$0.00</strong></td>
                </tr>
            </table>
            <form action="process_reservation.php" method="POST" id="reservationForm">
                <input type="hidden" name="adtype" value="<?php echo $service; ?>">
                <input type="hidden" name="dates">
                <input type="hidden" name="reserve" value="yes">
                <input type="hidden" name="subtotal">
                <input type="hidden" name="discount">
                <input type="hidden" name="total">
                <input type="hidden" name="time_created">
                <input type="hidden" name="calendar" value="<?php echo $calendar; ?>">
                <button class="btn btn-success" style="width: 100%;" type="submit">Reserve & Pay</button>
            </form> 
           

        </div>
    </div>
</div>
</div>
</div>

<script>
    let instance;

    function calculateBill() {
        const basePrice = <?php echo $service_price; ?> ;
        const tableBody = document.querySelector('.table tbody');
        const rowCount = tableBody.children.length;

        const subtotal = rowCount * basePrice;
        let discount = 0;

        if (rowCount >= 14) {
            discount = subtotal * 0.30;
        } else if (rowCount >= 7) {
            discount = subtotal * 0.15;
        } else if (rowCount >= 3) {
            discount = subtotal * 0.10;
        }

        const total = subtotal - discount;

        // Update bill values in the UI
        document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('discount').textContent = `$${discount.toFixed(2)}`;
        document.getElementById('total').textContent = `$${total.toFixed(2)}`;

        // Update hidden inputs in the form
        document.querySelector('input[name="subtotal"]').value = subtotal.toFixed(2);
        document.querySelector('input[name="discount"]').value = discount.toFixed(2);
        document.querySelector('input[name="total"]').value = total.toFixed(2);

        // Update dates in the form as JSON array
        const selectedDates = Array.from(tableBody.querySelectorAll('td:nth-child(2)')).map(td => td.textContent);
        document.querySelector('input[name="dates"]').value = JSON.stringify(selectedDates);
    }

    // Initialize Flatpickr
    document.addEventListener('DOMContentLoaded', function() {
        instance = flatpickr("#datepicker", {
            inline: true,
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: new Date().fp_incr(90),
            mode: "multiple",
            onChange: function(selectedDates, dateStr, instance) {
                const pillContainer = document.querySelector('.pillcontainer');
                pillContainer.innerHTML = ''; // Clear existing pills

                const tableBody = document.querySelector('.table tbody');
                tableBody.innerHTML = ''; // Clear existing rows

                selectedDates.forEach(date => {
                    // Create a new pill
                    const pill = document.createElement('div');
                    pill.classList.add('pill');
                    pill.textContent = instance.formatDate(date, "Y-m-d");

                    const closeButton = document.createElement('i');
                    closeButton.classList.add('bi', 'bi-x-circle-fill', 'pill-close');
                    pill.appendChild(closeButton);

                    pillContainer.appendChild(pill);

                    // Add a new row to the table
                    const row = document.createElement('tr');

                    const cellIndex = document.createElement('td');
                    cellIndex.textContent = tableBody.children.length + 1;

                    const cellDate = document.createElement('td');
                    cellDate.textContent = instance.formatDate(date, "Y-m-d");

                    const cellPrice = document.createElement('td');
                    cellPrice.textContent = '<?php echo $service_price ?>';

                    row.appendChild(cellIndex);
                    row.appendChild(cellDate);
                    row.appendChild(cellPrice);

                    tableBody.appendChild(row);
                });

                calculateBill(); // Recalculate the bill
            },
            onReady: function() {
                if ( <?php echo $calendar; ?> != 3) {
                    fetch('calendar.php?adtype=<?php echo $service ;?>')
                        .then(response => response.json())
                        .then(data => {
                            const disabledDates = data.map(item => item.start);
                            this.set('disable', disabledDates);
                        });
                }
            }
        });
    });

    // Event listener for removing pills and deselecting dates
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('pill-close')) {
            const pill = event.target.parentElement;
            const dateStr = pill.textContent.trim();

            // Convert date string back to Date object
            const dateToRemove = instance.parseDate(dateStr, "Y-m-d");

            if (dateToRemove) {
                // Remove the date and update the calendar
                const updatedDates = instance.selectedDates.filter(
                    date => date.getTime() !== dateToRemove.getTime()
                );

                instance.setDate(updatedDates, true); // Update Flatpickr with the remaining dates
                pill.remove(); // Remove the pill from the UI

                // Remove the corresponding row from the table
                const tableBody = document.querySelector('.table tbody');
                const rows = Array.from(tableBody.children);

                for (const row of rows) {
                    if (row.children[1].textContent === dateStr) {
                        tableBody.removeChild(row);
                        break;
                    }
                }

                // Recalculate row numbers
                Array.from(tableBody.children).forEach((row, index) => {
                    row.children[0].textContent = index + 1;
                });

                calculateBill(); // Recalculate the bill
            }
        }
    });



      // Initialize Select2
      $(document).ready(function() {
                $('#productName').select2({
                    placeholder: "Select an option",
                    allowClear: true // Adds a clear button
                });
            });




            document.addEventListener("DOMContentLoaded", function() {
                    // Function to get current time in YYYY-MM-DD HH:MM:SS format
                    function getCurrentUserTime() {
                        const now = new Date();
                        const year = now.getFullYear();
                        const month = String(now.getMonth() + 1).padStart(2, '0');
                        const day = String(now.getDate()).padStart(2, '0');
                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');
                        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
                    }

                    // Find the input field named 'time_created' or create one if it doesn't exist
                    let timeInput = document.querySelector("input[name='time_created']");
                    if (!timeInput) {
                        timeInput = document.createElement("input");
                        timeInput.type = "hidden";
                        timeInput.name = "time_created";
                        document.querySelector("form").appendChild(timeInput);
                    }

                    // Set the value of the input field to the current user time
                    timeInput.value = getCurrentUserTime();
                });

                // Add event listener to form submission
                document.getElementById('reservationForm').addEventListener('submit', function(event) {
                    // Get the dates input field value
                    const datesInput = document.querySelector('input[name="dates"]').value;

                    // Check if dates are selected
                    if (!datesInput || datesInput === '[]') {
                        // Prevent form submission if no dates are selected
                        event.preventDefault();
                        alert('Atleast One Day is required to Pay');
                    }
                });




                function convertDatesToFormFormat(dates) {
                    return dates.join(',');
                }

                document.getElementById('reservationForm').addEventListener('submit', function(event) {
                    const datesInput = document.querySelector('input[name="dates"]').value;
                    if (!datesInput || datesInput === '[]') {
                        event.preventDefault();
                        alert('At least one day is required to pay');
                    } else {
                        const datesArray = JSON.parse(datesInput);
                        document.querySelector('input[name="dates"]').value = convertDatesToFormFormat(datesArray);
                    }
                });
</script>
<?php } ?>
<br><br><br>
<?php
include 'footer.php';
?>