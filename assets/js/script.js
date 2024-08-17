'use strict';
import './modules/form.js';
import './modules/error.js';
import './modules/modal.js';
import formHandler from './modules/form.js';

////////////////////////////////////////////////////////////////////////////
//// Form handling
const form = document.querySelector('.form');
const winnerListContainer = document.querySelector('.winner__list');

form.addEventListener('submit', function (e) {
  e.preventDefault();

  const data = formHandler(new FormData(form));
  if (data) createWinnerDate(data);
});

// Recording data
const createWinnerDate = async function (data) {
  try {
    const response = await fetch('api.php?action=createWinnerDate', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    });

    const result = await response.json();

    console.log(result);
    if (result.status === 'success') {
      console.log('Successfully submitted');
    }
  } catch (error) {
    throw new Error('Failed creating new date: ', error.message);
  }
};

//Getting data
const getWinners = async function () {
  const res = await fetch('api.php?action=getWinners');
  const datas = await res.json();

  datas.forEach(data => {
    const item = document.createElement('li');
    item.textContent = `${data.date}, ${data.date_redimido}, ${data.email_participation}`;
    winnerListContainer.appendChild(item);
  });
};

getWinners();
