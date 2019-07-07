<template>

  <div class="score-menu">
    <span v-for="item in items" :key="item.id" class="score-dropdown__item">
      <input 
        type="checkbox"
        name="item[keyName]"
        class="mr-1"
        :value="[filter, item.id]"
        :checked="isChecked(filter, item.id)"
        v-model="selectedIds"
        v-on:input="selectedIds.push([filter, item.id])"
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
    filter: String,
    appliedFilters: Object,
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
  methods: {
    isChecked(filterType, id) {
      if (this.appliedFilters[filterType]) {
        return Object.values(this.appliedFilters[filterType]).indexOf(id) >= 0;
      }
      return false;
    }
  }
  

}
</script>

<style>

</style>
