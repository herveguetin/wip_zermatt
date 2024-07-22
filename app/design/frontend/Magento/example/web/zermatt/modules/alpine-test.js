export default {
    name: 'John Doe',
    greet() {
        return $t('Welcome to Zermatt %1', this.name)
    }
}
