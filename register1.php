<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="form-container">
        <h2>Registration Form</h2>
        <form action="save_register1.php" method="POST" enctype="multipart/form-data">

        <?php
            session_start();  
            if (!isset($_SESSION['email'])) {
                echo "No email found. Please go back to the first form.";
                exit();
            }
            ?>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>

            <label>First Name:</label>
            <input type="text" name="firstname" required>

            <label>Middle Name:</label>
            <input type="text" name="middlename">

            <label>Last Name:</label>
            <input type="text" name="lastname" required>

            <label>Age:</label>
            <input type="number" name="age" required>

            <label>Occupation:</label>
            <input type="text" name="occupation">

            <label>Marital Status:</label>
            <select name="marital_status">
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
            </select>

            <label>Gender:</label>
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label>Lot:</label>
            <input type="number" name="lot" value="<?php echo $_SESSION['lot']; ?>" readonly>
        
            <label>Block:</label>
            <input type="block" name="block" value="<?php echo $_SESSION['block']; ?>" readonly>

            <label>Address:</label>
            <select name="address">
                <option value="Dela Costa Homes V, Rodriguez, Rizal">Dela Costa Homes V, Rodriguez, Rizal</option>
            </select>

            <label>Date of Birth:</label>
            <input type="date" name="date_of_birth" required>

            <label>Religion:</label>
            <input type="text" name="religion" required>

            <label>Family Role:</label>
            <select name="family_role" required>
                <option value="Father">Father (Tatay)</option>
                <option value="Mother">Mother (Nanay)</option>
                <option value="Child">Child (Anak)</option>
                <option value="Grandmother">GrandMother (Lola)</option>
                <option value="Grandfather">GrandFather (Lolo)</option>
                <option value="Aunt">Auntie (Tita)</option>
                <option value="Uncle">Uncle (Tito)</option>
                <option value="Cousin">Cousin (Pinsan)</option>
            </select>

       
            <label for="image">Valid ID image:</label>
            <input type="file" name="image" id="image" required><br><br>


            <div class="terms-container">
                <label for="terms" class="terms-label">
                <input type="checkbox" name="terms" id="terms" required>
                <span>I agree to the <a href="#" id="termsLink">Terms and Conditions</a></span>
                </label>
            </div>
        

            <button type="submit" name="upload">Submit</button>
            
        </form>
    </div>

    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Terms and Conditions</h2>
            <div class="terms-content">
                <p>By accessing and using our services, you agree to abide by the following terms and conditions:</p>
                <ul>
                    <li>You agree that all the information you provide is accurate, complete, and truthful to the best of your knowledge. Providing false or misleading information may lead to disqualification from the census registration and potential penalties under applicable law.</li>
                    <li>Your personal data is collected for official census purposes only and will be handled in strict accordance with our data privacy policies and government regulations.</li>
                    <li>Information provided will be stored securely and will not be shared with unauthorized parties. We implement data protection measures to prevent unauthorized access, ensuring that your information is handled with care.</li>
                    <li>The information you provide will contribute to statistical and demographic analyses aimed at understanding population trends, resource allocation, and policy development.</li>
                    <li>Your responses will be aggregated with those of others and analyzed anonymously for planning, research, and community development initiatives.</li>
                    <li>The census authority reserves the right to update these terms and conditions at any time. Updates will be communicated as required and will take effect immediately upon posting.</li>
                </ul>
                <p>By submitting this form, you confirm that you have read and understood these terms and conditions. You agree to comply with them as part of your participation in the census program.</p>
            </div>
        </div>
    </div>
   
<style>

.terms-container {
    display: flex;
    align-items: center; /* Align items vertically */
    justify-content: center; /* Center horizontally if needed */
}

.terms-label {
    display: flex;
    align-items: center; /* Align the checkbox and text vertically */
    font-size: 14px;
    cursor: pointer;
}

.terms-label input[type="checkbox"] {
    margin-right: 8px; /* Space between checkbox and text */
    width: 16px; /* Adjust checkbox size if necessary */
    height: 16px;
}

/* Modal Background */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    overflow-y: auto; /* Enable scrolling if content is too long */
}

/* Modal Content */
.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 90%; /* Default width for mobile */
    max-width: 500px; /* Limit the maximum width */
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    word-wrap: break-word; /* Ensure long words break into the next line */
}

/* Close Button */
.close {
    color: #333;
    float: right;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #4CAF50;
    text-decoration: none;
}

/* Modal Header */
.modal-content h2 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #333;
    border-bottom: 2px solid #4CAF50;
    padding-bottom: 10px;
}

/* Modal Content Text */
.modal-content p,
.modal-content ul {
    font-size: 14px; /* Smaller font for readability on phones */
    line-height: 1.5;
}

.modal-content ul {
    padding-left: 20px; /* Indentation for lists */
}

.modal-content li {
    margin-bottom: 10px;
}

/* Responsive Design */
@media (min-width: 600px) {
    .modal-content {
        width: 70%; /* Slightly larger on tablets or bigger devices */
    }
}


</style>

    <script>
        // JavaScript for handling modal display
        var modal = document.getElementById("termsModal");
        var link = document.getElementById("termsLink");
        var closeBtn = document.getElementsByClassName("close")[0];

        link.onclick = function(event) {
            event.preventDefault();
            modal.style.display = "block";
        }

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


</body>
</html>
