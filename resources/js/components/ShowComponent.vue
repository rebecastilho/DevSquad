<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Produto {{produto.id}}</div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-4">Nome : {{produto.nome}}</div>
            </div>
            <div class="row">
              <div class="col-md-4">Descrição : {{produto.descricao}}</div>
            </div>
            <div class="row">
              <div class="col-md-4">Categoria : {{produto.categoria_id}}</div>
            </div>
            <div class="row">
              <div class="col-md-4">Preço : {{produto.preco}}</div>
            </div>
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
  created() {
    let uri = `http://localhost:8000/api/produto/show/${this.$route.params.id}`;
    this.axios.get(uri).then(response => {
      this.produto = response.data;
    });
  }
};
</script>
