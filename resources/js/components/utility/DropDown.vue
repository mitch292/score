<template>

  <div class="score-menu">
    <span v-for="item in items" :key="item.id" class="score-dropdown__item">
      <input 
        type="checkbox"
        name="item[keyName]"
        class="mr-1"
        :value="[filter, item.id]"
        v-model="selectedIds"
      >
        {{item[keyName]}}
    </span>
  </div>

</template>

<script>
export default {
  props: {
    items: Array,
    keyName: String,
    filter: String
  },
  data() {
    return {
      selectedIds: []
    }
  },
  watch: {
    selectedIds() {
      this.$emit('applyFilter', this.filter, this.selectedIds)
    }
  },
  

}
</script>

<style>

</style>
