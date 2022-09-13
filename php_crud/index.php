<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form validation and CRUD</title>
</head>
<body>
    <div class="container">
        <div class="title">
            Student Info Form
        </div>
        <form action="">
            <div class="field">
                <label for="fname">First name</label>
                <input type="text">
            </div>
            <div class="field">
                <label for="lname">Last name</label>
                <input type="text">
            </div>
            
            <div class="field">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                     <option value="0">Choose...</option>
                    <option value="">Male</option>
                    <option value="">Female</option>
                    <option value="">Other</option>
                </select>
            </div>
            <div class="field">
                <label for="phone">Phone</label>
                <input type="text">
            </div>
            <div class="field">
                <label for="email">email</label>
                <input type="text">
            </div>
            <div class="field">
                <label for="address">Address</label>
                <textarea name="address" id="address"></textarea>
            </div>
            <div class="field">
                <button type="submit" class="btn">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>