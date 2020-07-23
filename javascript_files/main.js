function logout() {
  // console.log(window.location.host);
  fetch('http://' + window.location.host +
    '/controllers/logout_controller.php')
    .then(res => {
      window.location.assign("http://" + window.location.host);
    })
}
