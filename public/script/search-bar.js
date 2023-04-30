// // Get references to the "from" and "to" date inputs
// const fromInput = document.querySelector('from-date');
// const toInput = document.querySelector('to-date');

// // Add an event listener to the "from" input to validate the date
// fromInput.addEventListener('change', function() {
//   // Parse the date from the input value
//   const fromDate = new Date(fromInput.value);

//   // If the date is invalid, clear the input and return
//   if (isNaN(fromDate.getTime())) {
//     fromInput.value = '';
//     return;
//   }

//   // If the "to" input already has a value, compare the dates
//   if (toInput.value) {
//     const toDate = new Date(toInput.value);
//     if (fromDate > toDate) {
//       toInput.value = '';
//       alert('The "to" date cannot be earlier than the "from" date.');
//     }
//   }
// });

// // Add an event listener to the "to" input to validate the date
// toInput.addEventListener('change', function() {
//   // Parse the date from the input value
//   const toDate = new Date(toInput.value);

//   // If the date is invalid, clear the input and return
//   if (isNaN(toDate.getTime())) {
//     toInput.value = '';
//     return;
//   }

//   // If the "from" input already has a value, compare the dates
//   if (fromInput.value) {
//     const fromDate = new Date(fromInput.value);
//     if (fromDate > toDate) {
//       toInput.value = '';
//       alert('The "to" date cannot be earlier than the "from" date.');
//     }
//   }
// });
