<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Adicionar Produto</div>
          <div class="card-body">
            <form @submit.prevent="addProduto">
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
                <button class="float-right btn btn-primary">Adicionar</button>
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
    };
  },
  methods: {
    addProduto() {
      let uri = "http://localhost:8000/api/produto/create";
      this.axios.post(uri, this.produto).then(response => {
        this.$router.push({ name: "produtos" });
      });
    }
  }
};
</script>