<section class="wallpaper darkmode webp" >
  <div id="wCore">
    <div id="aWindowSMTPer" class="aWindow on" >
      <div class="aWindow-header">
      <span class="aWindow-header-title">
      <strong>{ · SMTP</strong>
      </span>		
    </div>
    <div class="aWindow-flex">
      <!-- Left Menu -->
      <div class="aWindow-menu">
        <table style="width: 100%; height: 100%;">
          <tbody><tr style="height: 40px;">
            <td>
              <div class="nanoMenu">
                <div class="mobile-only textAlignRight">
                  <span class="leftMenuButton SwitchMenu"><i class="feather icon-menu fxNovak"></i></span>
                </div>
                <div class="aWindow-menu-item on">
                  Test &amp; Check<i class="floatRight feather icon-send"></i>
                </div>
              </div>
            </td>
          </tr>

          <tr>
            <td style="vertical-align: bottom;">
                <device include="Desktop">							
                  
                </device>
            </td>
          </tr>

        </tbody></table>
      </div>

      <!-- SMTPer window -->
      <form id="myForm" method="post" action="{{ env('APP_URL') . '/cms/wp-admin/admin-ajax.php?action=smtp' }}">
        <div class="aWindow-core loo">
          <div style="padding: 12px;">
            <table class="yo" style="width: 100%; height: 464px;">
              <tbody>
                <tr>
                  <td>
                    <label for="wSmtperTextHost" class="label important">SMTP host</label>
                    <input id="wSmtperTextHost" name="smtp_host" type="text" class="clear fxNovak" autofocus="" placeholder="required" style="width: 100%;">
                  </td>
                  <td class="tips no-narrow" style="width: 50%;">
                    <span class="comment">host or ip address of your smtp server (example: <span class="highlight">smtp.company.com</span>)</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="wSmtperTextPort" class="label">Port</label>
                    <input id="wSmtperTextPort" name="smtp_port" type="number" class="clear fxNovak" placeholder="required" style="width: 8rem;" value="25">
                  </td>
                  <td class="tips no-narrow">
                    <span class="comment">the default port is <span class="highlight">25</span>, but some smtp servers use a custom port (example: <span class="highlight">587</span>)</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input id="wSmtperCheckSecured" name="wSmtperCheckSecured" type="checkbox">
                    <label for="wSmtperCheckSecured">&nbsp; Use Secured Connection</label>
                  </td>
                  <td class="tips no-narrow">
                    <span class="comment">checked it only if the smtp server needs a secured connection (<span class="highlight">ssl, tsl</span>)</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input id="wSmtperCheckAuthentication" name="wSmtperCheckAuthentication" type="checkbox">
                    <label for="wSmtperCheckAuthentication">&nbsp; Use authentication</label>
                  </td>
                  <td class="tips no-narrow">
                    <span class="comment">most of smtp servers need an authentication (<span class="highlight">login/password</span>). Check it if required</span>
                  </td>
                </tr>
                <tr>
                  <td style="padding-left: 24px;">
                    <label for="wSmtperTextLogin" class="clear label">Login</label>
                    <input id="wSmtperTextLogin" name="smtp_login" type="text" class="clear fxNovak" placeholder="not required" style="width: calc(100% - 24px);">
                  </td>
                  <td class="tips no-narrow">
                    <span class="comment">required if 'Use authentication' is checked (ex: <span class="highlight">account</span> or <span class="highlight">account@foo.com</span>)</span>
                  </td>
                </tr>
                <tr>
                  <td class="" style="padding-left: 24px;">
                    <label for="wSmtperTextPassword" class="clear label">Password</label>
                    <input id="wSmtperTextPassword" name="smtp_pass" type="password" class="clear fxNovak" placeholder="not required" style="width: calc(100% - 24px);">
                  </td>
                  <td class="tips no-narrow">
                    <span class="comment">required if 'Use authentication' is checked</span>
                  </td>
                </tr>
                <tr>
                  <td class="">
                    <label for="wSmtperTextFrom" class="clear label orange">Email from</label>
                    <input id="wSmtperTextFrom" name="email_from" type="text" class="clear fxNovak" placeholder="required" style="width: 100%;">
                  </td>
                  <td class="tips no-narrow">
                    <span class="comment">the sender's email address (example: <span class="highlight">account@foo.com</span>)</span>
                  </td>
                </tr>
                <tr>
                  <td class="">
                    <label for="wSmtperTextTo" class="clear label orange">Email to</label>
                    <input id="wSmtperTextTo" name="email_to" type="text" class="clear fxNovak" placeholder="required" style="width: 100%;">
                  </td>
                  <td class="tips no-narrow">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <span class="comment">very important : the test mail will be sent to this address (ex: <span class="highlight">account@foo.com</span>)</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="xaWindow-footer" style="margin: 24px;">
            <div id="wSmtperLabelResult">Test your mail server</div>
            <button id="wSmtperSend" class="floatRight aWindow-button big fuchsia">{· <strong>Send</strong></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>