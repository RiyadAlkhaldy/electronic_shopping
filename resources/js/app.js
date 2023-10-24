import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// import Echo from 'laravel-echo'

// window.Echo = new Echo({
//   broadcaster: 'pusher',
//   key: '80f8b3df6f446dd581b9',
//   cluster: 'ap3',
//   forceTLS: true
// });

var channel = Echo.private(`App.Models.User.${userID}`);
// var channel = Echo.channel('my-channel');
// channel.listen('.my-event', function(data) {
channel.notification( function(data) {
    console.log(data);
  alert(JSON.stringify(data));
});
