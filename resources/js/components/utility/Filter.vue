<template>
  <div>

	<utility-menu>
		<button
			v-for="(item, index) in this.items"
			@click="toggleFilterDisplay" 
			:key="index"
			:name="item.listName"
			class="btn btn-secondary m-4">
			{{item.list.displayName}}
		</button>
	</utility-menu>


	<utility-dropdown
	  v-for="(item, index) in this.displayedItems"
	  :key="index"
	  :items="item.list.content"
	  :keyName="item.keyName"
	  :filter="item.listName"
	  @applyFilter="applyFilter"
	>
	</utility-dropdown>

  </div>
</template>

<script>
import UtilityDropdown from './DropDown.vue'
import UtilityMenu from './Menu.vue';
export default {
	components: {UtilityDropdown, UtilityMenu},
	data() {
		return {
			filterToShow: null,
			appliedFilters: {
				teams: {},
				viewingTypes: {},
				scoringTypes: {}
			}
		}
	},
	props: {
		items: Array,
	},
	computed: {
		displayedItems: function() {
			return this.items.filter(item => item.listName === this.filterToShow)
		}
	},
	methods: {
		toggleFilterDisplay(event) {
			this.filterToShow = this.filterToShow === event.target.name 
				? null 
				: event.target.name;
		},
		applyFilter(filterName, id, value) {
			console.log('hello', filterName, id, value)
			this.appliedFilters[filterName][id] = value;
		}
	}
}
</script>

<style>

</style>
