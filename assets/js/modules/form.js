////////////////////////////////////////////////////////////////////////////
//// Form Elements
const inputs = document.querySelectorAll('input');

////////////////////////////////////////////////////////////////////////////
//// Initial Variables
const validAsciiValues = [46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 95];
let invalids = [];

////////////////////////////////////////////////////////////////////////////
//// Validation Functions
const validateEmail = email => {
  if (!String(email) || email.length < 7 || !email.includes('@')) return;

  const [userName, domain] = email.trim().toLowerCase().split('@');
  if (userName.length < 3 || domain.length < 4 || !domain.includes('.')) return;

  const [domainName, com] = domain.split('.');
  if (domainName.length < 3 || com.length < 2) return;

  return [userName, domainName, com]
    .join('')
    .split('')
    .every(
      l =>
        (l.charCodeAt(0) >= 97 && l.charCodeAt(0) <= 122) ||
        validAsciiValues.includes(l.charCodeAt(0))
    );
};

const validateName = function (name) {
  if (name.trim().length < 3) return;

  return name
    .trim()
    .toLowerCase()
    .split(' ')
    .join('')
    .split('')
    .every(l => l.charCodeAt(0) >= 97 && l.charCodeAt(0) <= 122);
};

////////////////////////////////////////////////////////////////////////////
// Mapping "input names" with their functions
const validation = new Map([
  ['firstName', validateName],
  ['lastName', validateName],
  ['email', validateEmail],
]);

////////////////////////////////////////////////////////////////////////////
// Real time input entry checking
inputs.forEach(input => {
  input.addEventListener('change', function (e) {
    const validate = validation.get(input.name);

    let isValid = validate(input.value);

    input.style.boxShadow = `0px 0px 0px 3px ${
      isValid ? '#69db7c' : '#ff6b6b'
    }`;
  });
});

////////////////////////////////////////////////////////////////////////////
// Clearing input and status colors
const clearInputs = inputs =>
  inputs.forEach(input => {
    input.blur();

    if (!invalids.includes(input.name)) {
      input.value = '';
      input.style.boxShadow = `0px 0px 0px 3px transparent`;
    }
  });

////////////////////////////////////////////////////////////////////////////
// Root handling function
const formHandler = function (formData) {
  const data = {};

  console.log('???');

  for (const [key, val] of formData.entries()) {
    data[key] = val;
    if (!validation.get(key)(val)) invalids.push(key);
  }

  clearInputs(inputs);
  if (!invalids.length) return data;
  return true;
};

export default formHandler;
