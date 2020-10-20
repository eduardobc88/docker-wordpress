<?php
  global $siteURL;
?>
    <div id="footer-wrapper">
      <ul id="footer-links">
        <li>
          <a href="<?php echo $siteURL->we->url; ?>">
            Acerca de nosotros
          </a>
        </li>
        <li>
          <a href="<?php echo $siteURL->faq->url; ?>">
            Preguntas frecuentes
          </a>
        </li>
        <li>
          <a href="<?php echo $siteURL->contact->url; ?>">
            Contáctanos
          </a>
        </li>
        <li>
          <a href="<?php echo $siteURL->privacy->url; ?>">
            Aviso de privacidad
          </a>
        </li>
      </ul>
      <a href="<?php echo $siteURL->home->url; ?>">
        <img
          class="footer-logo"
          src=<?php echo get_stylesheet_directory_uri()."/asset/logo.png";?>>
      </a>
      <p>
        Afinsa.com © 2019. Todos los derechos reservados.
      </p>
      <p>
        Blvd. Miguel de Cervantes Saavedra #233 Piso 16, Col. Granada, CP. 11520, Ciudad de México
      </p>
      <p>
        Se informa que APJUSTO, S.A.P.I. de C.V., SOFOM E.N.R. es una Sociedad Financiera de Objeto Múltiple, Entidad No Regulada, que para su constitución y operación con tal carácter, no requiere de autorización de la Secretaría de Hacienda y Crédito Público, no obstante, se encuentra sujeta a la supervisión de la Comisión Nacional Bancaria y de Valores, únicamente para efectos de lo dispuesto por el artículo 56 de la Ley General de Organizaciones y Actividades Auxiliares del Crédito.
      </p>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
