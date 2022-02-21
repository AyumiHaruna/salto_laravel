<div class="row">
  <div class="{{ (( Session('role') != 5 )? 'col-sm-6 offset-sm-6' : 'col-sm-3 offset-sm-9' ) }} chat_client_window">
    <div class="row">

      @IF( Session('role') != 5 )
      <div class="col-sm-6">
        <div class="row justify-content-between chat_admin_title">
          <div class="col-sm-6 chat_admin_back_btn" id="chat_admin_back_btn">
            <button type="button" name="button"> <i class="fas fa-arrow-left fa-lg"></i> </button>
          </div>

          <div class="col-sm-6 chat_admin_upd_btn text-right" id="chat_admin_upd_btn">
            <button type="button" name="button"> <i class="fas fa-sync fa-lg"></i> </button>
          </div>
        </div>

        <div class="col-sm-12 chat_admin_msgList_block">
          <div class="row chat_admin_pendientes" id="chat_admin_pendientes">
            <div class="col-sm-12 title">
              Tickets pendientes <span>0</span>
            </div>
            <div class="col-sm-12 list">

            </div>
          </div>

          <div class="row chat_admin_activas" id="chat_admin_activas">
            <div class="col-sm-12 title">
              Conversaciones activas <span>0</span>
            </div>
            <div class="col-sm-12 list">

            </div>
          </div>
        </div>

        <div class="col-sm-12 chat_admin_msgList_old_chats">
          <div class="row">
            <div class="col-sm-12 old_chats_title text-center"></div>
            <div class="col-sm-12 old_chats_record"></div>
          </div>
        </div>
      </div>
      @ENDIF

      <div class="col-sm-{{ (( Session('role') != 5 )? '6' : '12' ) }}">
        <div class="row">
          <div class="col-sm-12 text-center chat_title" style="cursor:pointer;">
            CHAT
          </div>
          <div class="col-sm-12 chat_client_msgList_block">
            <div class="chat_client_msg_list">
              <div class="chat_right_msg">
                Hola gracias por confiar en SALTUM, <br>
                cuéntanos, ¿en que podemos ayudarte?
              </div>
            </div>
            <div class="row chat_client_msg_send_container">
              <div class="col-sm-10">
                <textarea name="name" rows="3" cols="80" class="form-control" id="chat_text_field" placeholder="Tu mensaje aquí..."></textarea>
                <input type="hidden" id="chat_hidden_role" value="{{ Session('role') }}">
                <input type="hidden" id="chat_hidden_client" value="{{ ((Session('role') == 5 )? Session('user')->id : '' ) }}">
                <input type="hidden" id="chat_hidden_support" value="{{ ((Session('role') != 5 )? Session('user')->id : '' ) }}">
                <input type="hidden" id="chat_hidden_url" value="{{ env('PUBLIC_URL').'/Chat' }}">
                <input type="hidden" id="chat_hidden_token" value="{{ csrf_token() }}">
                <input type="hidden" id="chat_hidden_id" value="">
              </div>
              <div class=col-sm-2>
                <button type="button"class="btn btn-big btn-block" id="chat_btn_submit" onclick="submit_chat_msg()"><i class="fas fa-angle-right fa-lg"></i></button>
                @IF( Session('role') != 5 )
                  <br>
                  <button type="button"class="btn btn-big btn-block chat_btn_close" id="chat_btn_close" onclick="close_chat_ticket()"><i class="far fa-stop-circle fa-lg"></i></button>
                @ENDIF
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
