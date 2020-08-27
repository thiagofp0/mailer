<?php if(!class_exists('Rain\Tpl')){exit;}?>
    <div class="pageContent">
        <div class="formRecipient">
            <h3 class="blueTitle">Novo Endereço</h3>
            <form action="#" method="post">
                <div class="field">
                    <label for="name"><h6 class="label">Nome:</h6></label>
                    <input type="text" name="name" id="recipientName" placeholder="Ex: Fulano De Tal" required>
                </div>
                <div class="field">
                    <label for="email"><h6 class="label">Email:</h6></label>
                    <input type="text" name="email" id="recipientEmail" placeholder="Ex: fulano@email.com" required>
                </div>
                <div class="field">
                    <label for="tag"><h6 class="label">Tag:</h6></label>
                    <input type="text" name="tag" id="recipientTag" placeholder="Cliente" required>
                </div>
                <button class="addRecipientButton">Adicionar Endereço</button>
            </form>
        </div>
    </div>