let ct = 1;
function addMP() {
    ct++;
    let container = document.getElementById('addMP');
    let html = `
        <fieldset class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Matéria-prima</label>
                <select name="und_id" class="form-select" required>
                    <option selected disabled value="">Selecione uma matéria-prima</option>
                    @foreach ($materiasprimas as $materiaprima)
                    <option value="{{ $materiaprima->id }}">{{ $materiaprima->nome }} || {{ $materiaprima->unidades->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Quantidade</label>
                <div class="input-group has-validation">
                    <input type="number" name="quantidade" class="form-control" placeholder="Ex: 1" required>
                    <select name="und_id" class="form-select" required>
                        <option selected disabled value="">Unidade de medida:</option>
                        @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">+ Matéria-prima</label>
                <div class="input-group has-validation">
                    <a class="btn btn-secondary" onclick="addMP()">Adicionar</a>
                </div>
            </div>
    </fieldset>
    `;
    container.innerHTML += html;
}


function adicionarMateriaPrima() {
    contador++;
    let container = document.getElementById('materias_primas_container');
    let html = `
        <div class="mb-3">
            <label for="materias_primas[${contador}][id]" class="form-label">Matéria-Prima:</label>
            <input type="text" class="form-control" id="materias_primas[${contador}][id]" name="materias_primas[${contador}][id]" required>
            <label for="materias_primas[${contador}][quantidade]" class="form-label">Quantidade:</label>
            <input type="number" class="form-control" id="materias_primas[${contador}][quantidade]" name="materias_primas[${contador}][quantidade]" required>
        </div>
    `;
}