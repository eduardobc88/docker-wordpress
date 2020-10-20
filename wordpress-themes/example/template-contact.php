<?php
/**
 * Template Name: Contact
 */
get_header();
wp_reset_query();
$post_url = get_permalink();
$page_image = get_image_src(get_post_thumbnail_id(get_the_id()), '1200x450');
?>
        <section id="contact-hero">
          <div id="hero-dark-bkg"></div>
          <div id="content-wrapper">
            <h1>
              Tenemos cobertura en todo México
            </h1>
          </div>
          <img
            class="background"
            src="<?php echo $page_image; ?>">
        </section>
        <section id="content">
          <p id="call-us">
            Llámanos
            <strong>
              800 269 0041
            </strong>
            escribenos
            <strong>
              contacto@afinsa.mx
            </strong>
          </p>
          <div id="location">
            <div id="address">
              <strong>
                Oficina CDMX
              </strong>
              Avenida Miguel de Cervantes Saavedra #233 Piso 16
              Colonia Granada Miguel Hidalgo
              CP 11520
              Ciudad de México
            </div>
            <div id="map">
              <iframe
                id="googla-map"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.1473323665373!2d-99.20232095018268!3d19.40603918683511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d201dd5a325891%3A0x7ee9a9cee10f0a22!2sGral+Mariano+Monterde+65%2C+Daniel+Garza%2C+11820+Ciudad+de+M%C3%A9xico%2C+CDMX%2C+M%C3%A9xico!5e0!3m2!1ses!2sus!4v1551229871685"
                frameborder="0"
                style="border:0"
                allowfullscreen>
              </iframe>
            </div>
          </div>
          <div id="contact-form-wrapper">
            <h2>
              Envianos tus comentarios
            </h2>
            <form
              id="contact-form"
              method="post"
              action="<?php echo $siteURL->contact_thanks->url; ?>"
              onsubmit="return validateContactFormFields()">
              <div class="grid-1-3">
                <div class="content">
                  <label>
                    Nombre
                    <input
                      type="text"
                      id="contact_name"
                      name="contact_name"
                      autocomplete="off"
                      placeholder="Eduardo"/>
                    <label
                      id="contact_name_error"
                      class="error-text">
                    </label>
                  </label>
                </div>
              </div>
              <div class="grid-3-5">
                <div class="content">
                  <label>
                    Apellido
                    <input
                      type="text"
                      id="contact_last_name"
                      name="contact_last_name"
                      autocomplete="off"
                      placeholder="Beltran"/>
                  </label>
                </div>
              </div>
              <div class="grid-1-5">
                <div class="content">
                  <label>
                    Correo
                    <input
                      type="text"
                      id="contact_email"
                      name="contact_email"
                      autocomplete="off"
                      placeholder="eduardobc.88@gmail.com"/>
                      <label
                        id="contact_email_error"
                        class="error-text">
                      </label>
                  </label>
                </div>
              </div>
              <div class="grid-1-5">
                <div class="content">
                  <label>
                    Teléfono
                    <input
                      type="text"
                      id="contact_phone"
                      name="contact_phone"
                      autocomplete="on"
                      placeholder="(000) 000 0000"/>
                      <label
                        id="contact_phone_error"
                        class="error-text">
                      </label>
                  </label>
                </div>
              </div>
              <div class="grid-1-5">
                <div class="content">
                  <label>
                    Mensaje
                    <textarea
                      id="contact_message"
                      name="contact_message"
                      placeholder="Escribe tu comentario...">
                    </textarea>
                    <label
                      id="contact_message_error"
                      class="error-text">
                    </label>
                  </label>
                </div>
              </div>
              <div class="grid-1-5">
                <div class="content">
                  <button id="submit-button">
                    Enviar
                  </button>
                </div>
              </div>
            </form>
          </div>
          <?php share_buttons($post_url); ?>
        </section>
<?php get_footer(); ?>
