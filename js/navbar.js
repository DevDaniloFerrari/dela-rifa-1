$(document).ready(function () {
  let url = window.location.search;
  let activeRoute = url.replace("?", "");
  switch (activeRoute) {
    case "modulo=Raffle&acao=home":
      $("#nav-index").addClass("active");
      break;
    case "modulo=Raffle&acao=store":
      $("#nav-raffles").addClass("active");
      break;
    case "modulo=Raffle&acao=about":
      $("#nav-about").addClass("active");
      break;
    case "modulo=Raffle&acao=contact":
      $("#nav-contact").addClass("active");
      break;
    case "modulo=Raffle&acao=partnership":
      $("#nav-partnership").addClass("active");
      break;
    case "modulo=User&acao=profile":
      $("#profileBtn").addClass("active");
      break;
    case "modulo=Raffle&acao=cart":
      $("#cartBtn").addClass("active");
      break;
    case "modulo=Raffle&acao=order":
      $("#orderBtn").addClass("active");
      break;
  }
});
