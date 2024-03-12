const cotizacionAlerta = async () => {
  var botonSubmit = document.getElementById("submit");
  let modal = new bootstrap.Modal(document.getElementById("exampleModal")); 
  modal.toggle();
  document.getElementById("exampleModalLabel").innerHTML = `Confirmación`;
  document.getElementById("modal-body").innerHTML = `
        <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
          <i class="fas fa-exclamation-triangle fa-5x mb-3"></i>
          <h2>¿Confirmas el envio al cliente?</h2>
          <p class="paragraph text-center">Presiona Confirmar para enviar la cotizacion al cliente.</p>
        </div>`;
  document.getElementById("modal-footer").innerHTML = `
        <button id="cerrar" type="button" class="buttonClose" data-bs-dismiss="modal">Cerrar</button>
        <button id="submit" type="button" href="./?controller=pages&action=cotizacion" class="button">Confirmar</button>
        `;
  modal.handleUpdate();

  document.getElementById("submit").onclick = function () {
    botonSubmit.click();
  };
};

const descarga = async () => {
  var submit = document.getElementById("descargar");
  let modal = new bootstrap.Modal(document.getElementById("exampleModal")); 
  modal.toggle();
  document.getElementById("exampleModalLabel").innerHTML = `Confirmación`;
  document.getElementById("modal-body").innerHTML = `
        <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
          <i class="fas fa-exclamation-triangle fa-5x mb-3"></i>
          <h2>Descarga del documento</h2>
          <p class="paragraph text-center">Presiona Confirmar para descargar tu cotizacion en PDF.</p>
        </div>`;
  document.getElementById("modal-footer").innerHTML = `
        <button id="cerrar" type="button" class="buttonClose" data-bs-dismiss="modal">Cerrar</button>
        <button id="descargar" type="button" href="./?controller=pages&action=descargarPDF" class="button">Confirmar</button>
        `;
  modal.handleUpdate();

  document.getElementById("descargar").onclick = function () {
    botonSubmit.click();
  };
};



const eliminarProducto = async (idproducto, elemento) => {
  // Restar una unidad por parte del BACK
  await $.ajax({
    url: "./?controller=pages&action=set_unidades",
    data: {
      id: idproducto,
    },
  });
  // Restar una unidad por parte del FRONT
  let unidades = parseInt(
    elemento.parentElement.parentElement.children[5].innerHTML
  );
  if (unidades > 1)
    elemento.parentElement.parentElement.children[5].innerHTML = unidades - 1;
  else {
    rowInd = elemento.parentElement.parentElement.rowIndex;
    document.getElementById("tablaCotizacion").deleteRow(rowInd);
  }
};

let abierto = false;
const mostrarBotonRemover = async () => {
  await $.ajax({
    url: "./?controller=pages&action=get_consultarProductosExtra",
    success: function (data) {
      resultado = JSON.parse(data);
      if (!Object.keys(resultado).length) {
        let modal = new bootstrap.Modal(
          document.getElementById("exampleModal")
        );
        modal.toggle();
        document.getElementById("exampleModalLabel").innerHTML = `Aviso`;
        document.getElementById("modal-body").innerHTML = `
        <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
          <i class="fas fa-exclamation-triangle fa-5x mb-3"></i>
          <h2>¡Agrega más productos!</h2>
          <p class="paragraph text-center">Para modificar tu cotización es necesario tener productos extra en tu cotización.</p>
        </div>`;
        document.getElementById("modal-footer").innerHTML = `
        <button id="cerrar" type="button" class="buttonClose" data-bs-dismiss="modal">Cerrar</button>`;
        modal.handleUpdate();
      } else {
        setTimeout(() => {
          abierto = true;
        }, 10);
        var x = document.getElementById("columnaRemover");
        var y = document.getElementsByClassName("columnaRemoverBoton");
        var botonEditarXS = document.getElementById("botonEditarCotizacionXS");
        var botonEditarLG = document.getElementById("botonEditarCotizacionLG");
        
        // Cambiar visibilidad de los botones
        if (x.style.display === "none") {
          x.style.display = "block";
          for (let i = 0; i < y.length; i++) {
            y[i].style.display = "block";
          }
          botonEditarLG.innerHTML = "Cotizar";
          botonEditarXS.innerHTML = "Cotizar";
        } else {
          x.style.display = "none";
          for (let i = 0; i < y.length; i++) {
            y[i].style.display = "none";
          }
          botonEditarLG.innerHTML = "Editar";
          botonEditarXS.innerHTML = "Editar";
        }
      }
    },
  });

  // Al darle click en confirmar recargar la pagina
  if (abierto) {
    let modal = new bootstrap.Modal(document.getElementById("exampleModal"));
    modal.toggle();
    document.getElementById("exampleModalLabel").innerHTML = `Confirmación`;
    document.getElementById("modal-body").innerHTML = `
        <div class="mb-3">
          <h2>¿Confirmar los cambios?</h2>
          <p class="paragraph">Presiona Confirmar para obtener tu cotización modificada.</p>
          <div class="d-flex justify-content-center">
          </div>  
        </div>`;
    document.getElementById("modal-footer").innerHTML = `
        <button id="cerrar" type="button" class="buttonClose" data-bs-dismiss="modal">Cerrar</button>
        <button id="submit" type="button" href="./?controller=pages&action=cotizacion" class="button">Confirmar</button>
        `;
    modal.handleUpdate();

    // Cerrar botonEditar, set abierto = false
    document.getElementById("cerrar").onclick = function () {
      abierto = false;
    };

    document.getElementById("submit").onclick = async function () {
      await $.ajax({
        url: "./?controller=pages&action=set_limpiar_productos",
        success: function () {
          window.location.replace("./?controller=pages&action=cotizacion");
        },
      });
    };
  }
};
