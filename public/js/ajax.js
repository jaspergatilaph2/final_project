fetch('/user/account/notifications/b2b9a124-3654-4406-9ba9-55f7c42f8aa9/read', {
  method: 'POST',
  headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken  // If applicable, e.g., in Laravel
  },
  body: JSON.stringify({/* your data */})
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error(error));
