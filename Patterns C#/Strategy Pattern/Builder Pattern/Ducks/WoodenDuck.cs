using Builder_Pattern.Fly;
using Builder_Pattern.Quack;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Builder_Pattern.Ducks
{
    class WoodenDuck : DuckBase
    {
        public WoodenDuck()
        {
            _flyable = new NoFly();
            _quackable = new NoQuack();
        }

        public override void Display()
        {
            Console.WriteLine("I'm a wooden Duck!");
        }
    }
}
