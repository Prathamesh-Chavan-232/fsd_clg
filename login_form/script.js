const form = document.getElementById("info");
const username = document.getElementById("name");
const age = document.getElementById("age");
const email = document.getElementById("email");
const pass = document.getElementById("pass");
const confirm_pass = document.getElementById("confirm");

form.addEventListener("submit", (event) => {
  validate();
  event.preventDefault();
});

const setError = (elem, msg) => {
  const field = elem.parentElement;
  const err = field.querySelector("div.error");
  err.innerText = msg;
  elem.classList.add("error");
  elem.classList.remove("success");
};

const setSuccess = (elem) => {
  const field = elem.parentElement;
  const err = field.querySelector("div.error");
  err.innerText = "";
  elem.classList.add("success");
  elem.classList.remove("error");
};

const isValidEmail = (emailVal) => {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(emailVal).toLowerCase());
};

const weakPass = (passVal) => {};

const validate = () => {
  const confirmVal = confirm_pass.value;
  const usernameVal = username.value;
  const emailVal = email.value;
  const passVal = pass.value;
  const ageVal = age.value;

  if (usernameVal === "" || usernameVal == null) {
    setError(username, "* Username is required");
  } else {
    setSuccess(username);
  }
  if (emailVal === "" || emailVal == null) {
    setError(email, "* Email is required");
  } else if (!isValidEmail(emailVal)) {
    setError(email, "Enter a valid email");
  } else {
    setSuccess(email);
  }
  if (ageVal === "" || ageVal == null) {
    setError(age, "* Age is required");
  } else if (isNaN(ageVal)) {
    setError(age, "Age must be a number");
  } else {
    setSuccess(age);
  }
  if (passVal === "" || passVal == null) {
    setError(pass, "* Set a password");
  } else {
    setSuccess(pass);
  }
  if (confirmVal === "" || confirmVal == null) {
    setError(confirm_pass, "* Re-type password");
  } else if (passVal != confirmVal) {
    setError(confirm_pass, "Passwords dont match");
  } else {
    setSuccess(confirm_pass);
  }
};
