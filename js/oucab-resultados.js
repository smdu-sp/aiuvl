var app = new Vue({
  el: "#apppainel",
  data: {
    registros: registros,
    colunas: [],
    nome_planilha: "Candidaturas OUCAB 2022",
    nome_arquivo: "Candidaturas OUCAB 2022",
  },
  methods: {
    exportaArquivo: function (tipo) {
      if (typeof tipo === "string") {
        var worksheet = XLSX.utils.json_to_sheet(this.registros);
        var workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, this.nome_planilha);
        XLSX.writeFile(workbook, this.nome_arquivo + "." + tipo);
      }
    },
    exibeModal: function () {
      var modal = document.getElementById("modalEnvio");
      modal.style.display = "flex";
    },
  },
  created: function () {
    for (coluna in this.registros[0]) {
      this.colunas.push(coluna);
    }
  },
});
