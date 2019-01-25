<template>
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">COMPETENCIAS</div>

          <div class="panel-body">
Edit: {{ user_id }}
              <div v-if="view.academico">
                <academico 
                  @changeAdd='changeAdd' 
                  @clearView='clearView' 
                  :user_id="user_id">
                  </academico>
              </div>
              <div v-if="view.publicacion"><publicacion :user_id="user_id"></publicacion></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import academico from './Academico';
  import publicacion from './Publicacion';
  export default {
    mounted(){
      console.log('cv/Edit.vue mounted');
    },
    components: {
      academico,
      publicacion,
    },
    props: [],
    data() {
      return {
        view: {
          academico: true,
          publicacion: true
        },

        user_id: 1
      };
    },
    computed: {

    },
    methods:{
      changeAdd: function(tipo) {
        for (var i in this.view) {
          if(i == tipo){
            this.view[i] = true;
          }else{
            this.view[i] = false;
          }
        };
      },
      clearView: function () {
        for (var i in this.view) {
          this.view[i] = true;
        }
      }
    },
  }

</script>
