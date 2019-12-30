<field-wufoo-select>
  <div class="uk-margin uk-panel uk-panel-card uk-panel-box" if="{item}">
    <div class="uk-flex">
      <span class="uk-flex-item-1">
        {item}
      </span>
      <a class="uk-margin-small-left uk-text-danger" role="button" onclick="{ clearEntry }">
        <i class="uk-icon-trash-o" />
      </a>
    </div>
  </div>
  <div ref="select" class="uk-form uk-form-icon">
      <option value="{form.value}" each="{form in forms}">{form.title}</option>
  </div>
  <script>
    var $this = this;
    var item;
    this.getData = function() {
        return fetch(`/api/wufoo/forms/?key=${$this.opts.key}`)
          .then(function(response) {
            return response.json()
          })
          .then(function(response) {
            var items =  response.Forms;
            if(items && items.length > 0) {
              return items.map(function(item) {
                return {
                  value: item.Hash,
                  title: item.Name
                }
              })
            }
          })
    }

    this.clearEntry = function(event) {
      event.preventDefault();
      $this.item = null;
      $this.$setValue(null, false, opts.bind);
      $this.$setValue(null, false, opts.bind + '_title');
    }

    this.on('mount', async function() {
      this.item = this.$getValue(opts.bind + '_title');
      this.forms = await this.getData()
    });

    this.selectForm = function(data) {
      $this.item = data.title;
      $this.$setValue(data.value, false, opts.bind);
      $this.$setValue(data.title, false, opts.bind + '_title');
      setTimeout(function() {
        $this.refs.input.value = ''
      },0);
    }
  </script>
</field-wufoo-select>