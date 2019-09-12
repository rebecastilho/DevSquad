<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Atualizar Produto</div>
          <div class="card-body">
            <form @submit.prevent="updateProduto">
              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" class="form-control" v-model="produto.nome" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Descrição:</label>
                    <textarea class="form-control" v-model="produto.descricao" rows="5"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Categoria:</label>
                    <input type="text" class="form-control" v-model="produto.categoria_id" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Preco:</label>
                    <input type="text" class="form-control" v-model="produto.preco" />
                  </div>
                </div>
              </div>

              <div class="form-group">
                <button class="float-right btn btn-primary">Atualizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {

      data() {
        return {
          produto: {}
        }
      },
      created() {
        let uri = `http://localhost:8000/api/produto/show/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.produto = response.data;
        });
      },
      methods: {
        updateProduto() {
          let uri = `http://localhost:8000/api/produto/update/${this.$route.params.id}`;
          this.axios.post(uri, this.produto).then((response) => {
            this.$router.push({name: 'produtos'});
          });
        }
      }
    }
</script>