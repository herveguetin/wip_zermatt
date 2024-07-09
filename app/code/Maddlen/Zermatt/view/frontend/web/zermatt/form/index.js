/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */
export default {
    success: false,
    submitted: false,
    form: null,
    async init() {
        this.fetchFormKey().then(formKey => {
            const form = this.$el.querySelector('form')
            let formData = JSON.parse(form.getAttribute('x-data'))
            formData.form_key = formKey
            this.form = this.$form('post', form.getAttribute('action'), formData)
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
        let form = this.$el.querySelector('form')
        this.form.submit()
            .then(response => {
                this.form.reset()
                form.reset()
                this.success = true
                this.submitted = false
                this.onSuccess(response)
                setTimeout(() => {
                    this.success = false
                }, 4500)
            })
            .then(() => form.scrollIntoView())
            .catch(error => {
                console.log('Form has errors and was not submitted.')
            })
    }
}
