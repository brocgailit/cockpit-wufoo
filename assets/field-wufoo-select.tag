<field-wufoo-select>
  <select ref="input" class="uk-select {opts.cls}" onchange="{changeOption}" show="{element == 'select'}">
    <option value="">{loading ? "loading..." : App.i18n.get("- Select -")}</option>
    <option value="{form.value}" each="{form in forms}" selected="{form.value === value}">{form.title}</option>
  </select>
  <script>
    var $this = this;
    this.forms = [];
    this.element = 'select';
    this.value = null;

    this.getData = function() {
        return fetch(`/api/wufoo/forms/?token=${$this.opts.key}`)
          .then(function(response) {
            return response.json()
          })
          .then(function(response) {
            var items =  response.Forms;
            console.log(items);
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

    this.on('update', function() {
        if (opts.required) {
            this.refs.input.setAttribute('required', 'required');
        }
    });

    this.$updateValue = function(value, field) {
        this.value = value;
        this.update();
    }.bind(this);

    changeOption(e) {
        if ($this.forms && $this.forms.some(f => f.value === e.target.value)) {
            $this.value = $this.forms.find(f => f.value === e.target.value);
            $this.$setValue($this.value);
        }
    }

    this.on('mount', async function() {
        $this.loading = true;
        this.refs.input.value = this.root.$value;
        $this.item = this.$getValue(opts.bind + '_title');
        $this.forms = await this.getData()
        $this.loading = false;
    });
  </script>

</field-wufoo-select>