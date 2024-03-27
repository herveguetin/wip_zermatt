/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */
export default {
    success: false,
    submitted: false,
    form: null,
    async init() {
        this.fetchFormKey().then(formKey => {
            let formData = JSON.parse(this.$refs.form.getAttribute('x-data'))
            formData.form_key = formKey
            this.form = this.$form('post', this.$refs.form.getAttribute('action'), formData)
        })
    },
    async fetchFormKey() {
        const response = await fetch(Zermatt.Variables.formKeyUrl, {method: 'POST'})
        const json = await response.json()
        return json.form_key
    },
    onSuccess(response) {
        window.location.href = response.data.redirect
    },
    submit() {
        this.submitted = true
        this.form.submit()
            .then(response => {
                this.form.reset()
                this.$refs.form.reset()
                this.success = true
                this.submitted = false
                this.onSuccess(response)
                setTimeout(() => {
                    this.success = false
                }, 4500)
            })
            .then(this.$refs.form.scrollIntoView())
            .catch(error => {
                console.log('Form has errors and was not submitted.')
            })
    }
}
