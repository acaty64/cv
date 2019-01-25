<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">Publicaciones
            <button class="btn-small" style="float: right"><span class="glyphicon glyphicon-plus"></span></button>
          </div>

          <div class="panel-body">
              Publicaciones: {{ user_id }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted() {
      console.log('Publicacion mounted.');
    },
    props: ['user_id'],
    data() {
      return { 
        titulo:"",
        descripcion:""
      };
    },

  }
</script>
