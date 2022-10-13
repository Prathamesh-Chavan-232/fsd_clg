const form = document.getElementById("info");
const Name = document.getElementById("name");
const age = document.getElementById("age");
const email = document.getElementById("email");
const pass = document.getElementById("pass");
const confirmPass = document.getElementById("confirm");
const res = document.getElementById("res");

form.addEventListener("submit", (err) => {
  let error = [];
  if (Name.value === "" || Name.value == null) {
    error.push("Name is required");
  }
  if (email.value === "" || email.value == null) {
    error.push("Email is required");
  }
  if (age.value == null || age.value === "") {
    error.push("age is required");
  }
  if (isNaN(age.value)) {
    error.push("age must be a number");
  }
  if (error.length > 0) {
    res.innerText = error.join(", ");
  } else {
    res.innerText =
      "Input is valid\n Username - " +
      Name.value +
      "\nAge - " +
      age.value +
      "\nEmail Address - " +
      email.value;
  }
  err.preventDefault();
});
