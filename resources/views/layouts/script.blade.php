  <script src="/assets/static/js/components/dark.js"></script>
  <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="/assets/compiled/js/app.js"></script>
  <script src="/assets/js/tooltip.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/assets/js/form/changePassword.js"></script>
  <script>
      let modalChangePassword = $("#modal-change-password");
      let changePasswordLama = $("#password_lama");
      let btnChangePassword = $('#btnChangePassword')

      btnChangePassword.on("click", function() {
          modalChangePassword.modal("show");
      })

      modalChangePassword.on("shown.bs.modal", function() {
          changePasswordLama.focus();
      });
  </script>
  @stack('scripts')
  </body>

  </html>
